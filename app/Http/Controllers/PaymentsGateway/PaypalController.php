<?php
namespace App\Http\Controllers\PaymentsGateway;

use App\Models\PaymentsGateway\Paypal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaypalController extends BaseGatewayController
{
    // PayPal REST API v2 integration
    public function createOrder(Request $request)
    {
        // 1. Get PayPal credentials from payment_gateways table
        $gateway = DB::table('payment_gateways')->where('keyword', 'paypal')->first();
        if (!$gateway || empty($gateway->information)) {
            return back()->withErrors(['PayPal credentials not configured.']);
        }
        $info = is_array($gateway->information)
            ? $gateway->information
            : json_decode($gateway->information, true);
        $clientId = $info['client_id'] ?? null;
        $secret = $info['client_secret'] ?? null;
        if (empty($clientId) || empty($secret)) {
            return back()->withErrors(['PayPal credentials not configured.']);
        }

        // 2. Get access token
        $tokenRes = Http::withBasicAuth($clientId, $secret)
            ->asForm()
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials'
            ]);
        if (!$tokenRes->ok() || empty($tokenRes['access_token'])) {
            return back()->withErrors(['Unable to get PayPal access token.']);
        }
        $accessToken = $tokenRes['access_token'];

        // 3. Prepare order data
        $planId = $request->input('plan_id');
        $productId = $request->input('product_id');
        $amount = DB::table('pricings')->where('id', $planId)->value('price');
        if (!$amount) {
            return back()->withErrors(['Invalid plan selected.']);
        }
        // Create subscription record
        $subscriptionId = DB::table('subscriptions')->insertGetId([
            'user_name' => $request->input('name'),
            'user_email' => $request->input('email'),
            'user_phone' => $request->input('phone_number'),
            'product_id' => $productId,
            'plan_id' => $planId,
            'status' => 'I',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($amount, 2, '.', ''),
                ],
                'custom_id' => (string)$subscriptionId,
            ]],
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
        ];

        Log::debug('PayPal Order Payload', ['payload' => $orderData]);
        $orderRes = Http::withToken($accessToken)
            ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', $orderData);
        Log::debug('PayPal Order Response', ['status' => $orderRes->status(), 'body' => $orderRes->body()]);
        if (!$orderRes->ok() || empty($orderRes['id'])) {
            return back()->withErrors(['Unable to create PayPal order.']);
        }

        // Save PayPal order ID in subscription
        DB::table('subscriptions')->where('id', $subscriptionId)->update([
            'pmt_response' => json_encode($orderRes->json()),
            'updated_at' => now(),
        ]);

        // Find approval link and redirect
        $approveUrl = null;
        foreach ($orderRes['links'] as $link) {
            if (isset($link['rel']) && $link['rel'] === 'approve') {
                $approveUrl = $link['href'];
                break;
            }
        }
        if ($approveUrl) {
            return redirect()->away($approveUrl);
        }
        return back()->withErrors(['PayPal approval link not found.']);
    }

    public function success(Request $request)
    {
        // 1. Get PayPal credentials
        $gateway = DB::table('payment_gateways')->where('keyword', 'paypal')->first();
        if (!$gateway || empty($gateway->information)) {
            return back()->withErrors(['PayPal credentials not configured.']);
        }
        $info = is_array($gateway->information)
            ? $gateway->information
            : json_decode($gateway->information, true);
        $clientId = $info['client_id'] ?? null;
        $secret = $info['client_secret'] ?? null;
        if (empty($clientId) || empty($secret)) {
            return back()->withErrors(['PayPal credentials not configured.']);
        }

        // 2. Get access token
        $tokenRes = Http::withBasicAuth($clientId, $secret)
            ->asForm()
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials'
            ]);
        if (!$tokenRes->ok() || empty($tokenRes['access_token'])) {
            return back()->withErrors(['Unable to get PayPal access token.']);
        }
        $accessToken = $tokenRes['access_token'];

        // 3. Capture order
        $orderId = $request->query('token');
        if (!$orderId) {
            return back()->withErrors(['Missing PayPal order token.']);
        }
        $captureRes = Http::withToken($accessToken)
            ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}/capture");
        if (!$captureRes->ok()) {
            return back()->withErrors(['Unable to capture PayPal order.']);
        }

        // Get custom_id from response
        $customId = null;
        if (!empty($captureRes['purchase_units'][0]['custom_id'])) {
            $customId = $captureRes['purchase_units'][0]['custom_id'];
        }
        if ($customId) {
            DB::table('subscriptions')->where('id', $customId)->update([
                'status' => 'P',
                'pmt_response' => json_encode($captureRes->json()),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('checkout', ['productId' => $request->query('product_id')])->with('success', 'Payment successful!');
    }

    public function cancel(Request $request)
    {
        // Redirect back to checkout with error
        return redirect()->route('checkout', ['productId' => $request->query('product_id')])->withErrors(['Payment cancelled.']);
    }

    public function payWithPayPal(Request $request)
    {
        $plan = DB::table('pricings')->where('id', $request->plan_id)->first();
        if (!$plan) {
            return response()->json(['error' => 'Invalid plan selected.'], 400);
        }
        $gateway = DB::table('payment_gateways')->where('keyword', 'paypal')->first();
        if (!$gateway || empty($gateway->information)) {
            return response()->json(['error' => 'PayPal credentials not configured.'], 500);
        }
        $info = is_array($gateway->information)
            ? $gateway->information
            : json_decode($gateway->information, true);
        $clientId = $info['client_id'] ?? null;
        $clientSecret = $info['client_secret'] ?? null;
        if (!$clientId || !$clientSecret) {
            return response()->json(['error' => 'PayPal client_id or client_secret missing.'], 500);
        }
        // Get access token
        $tokenRes = Http::withBasicAuth($clientId, $clientSecret)
            ->asForm()
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials'
            ]);
        if (!$tokenRes->ok() || empty($tokenRes['access_token'])) {
            Log::error('PayPal Access Token Error', ['status' => $tokenRes->status(), 'body' => $tokenRes->body()]);
            return response()->json(['error' => 'Unable to get PayPal access token.'], 500);
        }
        $accessToken = $tokenRes['access_token'];
        // Prepare order data
        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($plan->price, 2, '.', ''),
                ],
            ]],
            'application_context' => [
                'return_url' => url('/paypal/success'),
                'cancel_url' => url('/paypal/cancel'),
            ],
        ];
        // Create PayPal order
        Log::debug('PayPal Order Payload', ['payload' => $orderData]);
        $orderRes = Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', $orderData);
        Log::debug('PayPal Order Response', ['status' => $orderRes->status(), 'body' => $orderRes->body()]);
        if (!$orderRes->ok()) {
            Log::error('PayPal Order Creation Failed', ['status' => $orderRes->status(), 'body' => $orderRes->body()]);
            return response()->json([
                'error' => 'Unable to create PayPal order.',
                'paypal_response' => $orderRes->json(),
            ], 500);
        }
        return response()->json($orderRes->json());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paypal $paypal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paypal $paypal)
    {
        // Return a view to edit status, client id, and client secret for the given Paypal gateway
        return view('Payments.edit-paypal', [
            'paypal' => $paypal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'card_title' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
                'environment' => 'required|in:sandbox,production',
                'client_id' => 'required|string|max:255',
                'client_secret' => 'required|string|max:255',
            ]);

            // Debug log to check what's being submitted
            Log::info('PayPal form submission', [
                'status' => $validated['status'] ?? 'missing',
                'all_input' => $request->all(),
                'validated' => $validated
            ]);

            // Use base controller method for consistent handling
            $this->updateGatewayConfig('paypal', $validated, 'status', ['client_secret']);

            $isActive = $validated['status'] === 'active';
            
            // Verify the update was successful
            $updated = DB::table('payment_gateways')->where('keyword', 'paypal')->first();
            Log::info('PayPal updated in database', [
                'is_active' => $updated->is_active ?? 'not found',
                'information' => $updated->information ?? 'not found'
            ]);

            return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully. Status: ' . ($isActive ? 'Active' : 'Inactive'));
            
        } catch (\Exception $e) {
            Log::error('PayPal update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to update PayPal settings: ' . $e->getMessage()]);
        }
    }
}
