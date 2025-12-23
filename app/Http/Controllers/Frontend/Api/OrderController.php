<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Pricing;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Store a new order/purchase
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'pricing_id' => 'required|exists:pricings,id',
            'payment_gateway' => 'required|exists:payment_gateways,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        try {
            $product = Product::findOrFail($request->product_id);
            $pricing = Pricing::findOrFail($request->pricing_id);
            $gateway = PaymentGateway::findOrFail($request->payment_gateway);

            // Generate unique transaction ID
            $transactionId = 'TXN-' . strtoupper(Str::random(10));

            // Create checkout record first (needed for payment gateway integration)
            $checkout = \App\Models\Checkout::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $request->product_id,
                'plan_id' => $request->pricing_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'company' => $request->company,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'payment_gateway' => $gateway->keyword,
                'payment_method' => $gateway->keyword,
                'amount' => $pricing->price,
                'currency' => $pricing->region === 'I' ? 'INR' : 'USD',
                'status' => 'pending',
                'order_id' => $transactionId,
            ]);

            // Create purchase record (linked to checkout)
            $purchase = Purchase::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $request->product_id,
                'pricing_id' => $request->pricing_id,
                'transaction_id' => $transactionId,
                'payment_gateway' => $gateway->keyword,
                'payment_method' => $gateway->keyword,
                'amount' => $pricing->price,
                'currency' => $pricing->region === 'I' ? 'INR' : 'USD',
                'status' => 'pending',
                'payment_data' => [
                    'gateway_name' => $gateway->name,
                    'gateway_id' => $gateway->id,
                    'checkout_id' => $checkout->id,
                    'created_at' => now()->toISOString()
                ],
                'user_details' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'company' => $request->company,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                ]
            ]);

            // Generate payment URL based on selected gateway
            $paymentUrl = $this->generatePaymentUrl($gateway->keyword, $checkout->id);

            return response()->json([
                'success' => true,
                'data' => [
                    'transaction_id' => $purchase->transaction_id,
                    'purchase_id' => $purchase->id,
                    'checkout_id' => $checkout->id,
                    'amount' => $purchase->amount,
                    'currency' => $purchase->currency,
                    'status' => $purchase->status,
                    'payment_url' => $paymentUrl,
                    'gateway' => $gateway->keyword
                ],
                'message' => 'Order created successfully. Redirecting to payment gateway...'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show order details
     */
    public function show($id)
    {
        try {
            $purchase = Purchase::with(['product', 'pricing'])
                ->where('id', $id)
                ->orWhere('transaction_id', $id)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $purchase,
                'message' => 'Order retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Generate payment URL based on gateway
     */
    private function generatePaymentUrl($gateway, $checkoutId)
    {
        switch (strtolower($gateway)) {
            case 'cashfree':
                return route('cashfree.create', $checkoutId);
            case 'paypal':
                return route('paypal.create', $checkoutId);
            case 'stripe':
                return route('stripe.create', $checkoutId);
            case 'phonepe':
                return route('phonepe.create', $checkoutId);
            case 'easebuzz':
                return route('easebuzz.create', $checkoutId);
            default:
                throw new \Exception('Unsupported payment gateway: ' . $gateway);
        }
    }
}



