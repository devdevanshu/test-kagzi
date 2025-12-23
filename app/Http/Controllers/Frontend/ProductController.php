<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\PaymentGateway;
use App\Models\Purchase;
use App\Models\Checkout;
use App\Services\Payment\ProductSyncService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productSyncService;

    public function __construct(ProductSyncService $productSyncService)
    {
        $this->productSyncService = $productSyncService;
    }
    /**
     * Display product showcase page
     */
    public function showcase()
    {
        $products = $this->productSyncService->getActiveProducts();
        
        return view('frontend.products.showcase', compact('products'));
    }

    /**
     * Display single product details
     */
    public function showPublic($slug)
    {
        $product = $this->productSyncService->getProductBySlug($slug);
        
        if (!$product) {
            abort(404, 'Product not found');
        }
            
        return view('frontend.products.show', compact('product'));
    }

    /**
     * Get active payment gateways (Only Cashfree and PayPal)
     */
    public function getActiveGateways()
    {
        try {
            // Use shared database configuration to get active payment gateways
            // Check both is_active field and information.status for compatibility
            $gateways = \Illuminate\Support\Facades\DB::connection('mysql')
                ->table('payment_gateways')
                ->where('is_active', 1)
                ->whereIn('keyword', ['cashfree', 'paypal'])
                ->get(['id', 'name', 'keyword', 'information', 'is_active']);  
                
            \Illuminate\Support\Facades\Log::info('Payment gateways query result', [
                'count' => $gateways->count(),
                'gateways' => $gateways->toArray(),
                'database' => config('database.default')
            ]);
            
            $activeGateways = [];
            foreach ($gateways as $gateway) {
                $info = json_decode($gateway->information, true);
                
                // Only include if is_active = 1 (simplified check)
                if ($gateway->is_active == 1) {
                    $activeGateways[] = [
                        'id' => $gateway->id,
                        'name' => $gateway->name,
                        'keyword' => $gateway->keyword,
                        'description' => $this->getGatewayDescription($gateway->keyword),
                        'logo' => $this->getGatewayLogo($gateway->keyword),
                        'supported_currencies' => $this->getSupportedCurrencies($gateway->keyword),
                        'information' => $info,
                        'is_active' => $gateway->is_active
                    ];
                }
            }
            
            \Illuminate\Support\Facades\Log::info('Active gateways filtered', [
                'active_count' => count($activeGateways),
                'active_gateways' => $activeGateways
            ]);
            
            return response()->json([
                'success' => true,
                'gateways' => $activeGateways,
                'total' => count($activeGateways),
                'message' => 'Active payment gateways retrieved successfully'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Payment gateway fetch error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get payment gateways: ' . $e->getMessage(),
                'error' => $e->getMessage(),
                'debug' => [
                    'available_gateways' => \Illuminate\Support\Facades\DB::table('payment_gateways')->select('keyword', 'is_active', 'information')->get()
                ]
            ], 500);
        }
    }

    /**
     * Get gateway logo URL
     */
    private function getGatewayLogo($keyword)
    {
        $logos = [
            'cashfree' => asset('assets/images/payment/cashfree-logo.png'),
            'paypal' => asset('assets/images/payment/paypal-logo.png'),
        ];
        
        return $logos[$keyword] ?? asset('assets/images/payment/default-payment.png');
    }

    /**
     * Get supported currencies for gateway
     */
    private function getSupportedCurrencies($keyword)
    {
        $currencies = [
            'cashfree' => ['INR'],
            'paypal' => ['USD', 'INR'],
        ];
        
        return $currencies[$keyword] ?? [];
    }

    /**
     * Process payment through selected gateway
     */
    public function processPayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'plan_id' => 'required|exists:pricings,id',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'whatsapp' => 'required|string',
                'payment_method' => 'required|string',
            ]);

            // Get product and pricing details
            $product = $this->productSyncService->getProductById($validated['product_id']);
            $pricing = \DB::table('pricings')->where('id', $validated['plan_id'])->first();

            if (!$product || !$pricing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product or pricing not found'
                ], 404);
            }

            // Create order record
            $order = \DB::table('subscriptions')->insertGetId([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['whatsapp'],
                'product_id' => $validated['product_id'],
                'plan_id' => $validated['plan_id'],
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Process payment based on gateway
            $paymentUrl = $this->initiatePayment($validated['payment_method'], $order, $pricing, $validated);

            return response()->json([
                'success' => true,
                'payment_url' => $paymentUrl,
                'order_id' => $order
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Initiate payment with selected gateway
     */
    private function initiatePayment($gateway, $orderId, $pricing, $orderData)
    {
        switch ($gateway) {
            case 'paypal':
                return $this->initiatePayPalPayment($orderId, $pricing, $orderData);
            case 'cashfree':
                return $this->initiateCashfreePayment($orderId, $pricing, $orderData);
            default:
                throw new \Exception('Unsupported payment gateway');
        }
    }

    /**
     * Process gateway payment for product purchase
     */
    public function processGatewayPayment(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'gateway' => 'required|string',
                'product_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'whatsapp' => 'required|string'
            ]);
            
            $gateway = $request->input('gateway');
            $productId = $request->input('product_id');
            $planId = $request->input('plan_id');
            $fullName = $request->input('full_name');
            $email = $request->input('email');
            $whatsapp = $request->input('whatsapp');
            
            // Get product with pricing
            $product = Product::with(['pricings' => function($query) use ($planId) {
                $query->where('id', $planId);
            }])->find($productId);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }
            
            $pricing = $product->pricings->first();
            if (!$pricing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pricing plan not found'
                ], 404);
            }
            
            // Validate gateway is active
            $paymentGateway = \DB::table('payment_gateways')
                ->where('keyword', $gateway)
                ->where('is_active', 1)
                ->whereJsonContains('information->status', 'active')
                ->first();
            
            if (!$paymentGateway) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment gateway not available'
                ], 400);
            }
            
            // Generate unique transaction ID
            $transactionId = 'TXN_' . time() . '_' . uniqid();
            
            // Create purchase record (handle both authenticated and guest users)
            $purchase = Purchase::create([
                'product_id' => $product->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'pricing_id' => $pricing->id,
                'transaction_id' => $transactionId,
                'payment_gateway' => $gateway,
                'payment_method' => $gateway, // Default to gateway name
                'amount' => $pricing->price,
                'currency' => $pricing->region == 'D' ? 'INR' : 'USD',
                'status' => 'pending',
                'payment_data' => [
                    'pricing_title' => $pricing->title,
                    'company' => $request->input('company', ''),
                    'address' => $request->input('address', ''),
                    'city' => $request->input('city', ''),
                    'postal_code' => $request->input('postal_code', '')
                ],
                'user_details' => [
                    'name' => $fullName,
                    'email' => $email,
                    'whatsapp' => $whatsapp,
                ]
            ]);
            
            // Create checkout record for gateway processing (uses subscriptions table)
            $checkout = Checkout::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'name' => $fullName,
                'email' => $email,
                'phone_number' => $whatsapp,
                'company' => $request->input('company', ''),
                'address' => $request->input('address', ''),
                'city' => $request->input('city', ''),
                'postal_code' => $request->input('postal_code', ''),
                'product_id' => $product->id,
                'plan_id' => $pricing->id,
                'payment_gateway' => $gateway,
                'payment_method' => $gateway,
                'amount' => $pricing->price,
                'currency' => $pricing->region == 'D' ? 'INR' : 'USD',
                'status' => 'pending',
                'transaction_id' => $transactionId,
                'purchase_date' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            // Generate payment URL based on gateway
            $paymentUrl = $this->generatePaymentUrl($checkout->id, $gateway);
            
            return response()->json([
                'success' => true,
                'message' => 'Payment initiated successfully',
                'redirect_url' => $paymentUrl,
                'transaction_id' => $transactionId,
                'checkout_id' => $checkout->id,
                'purchase_id' => $purchase->id,
                'amount' => $pricing->price,
                'currency' => $pricing->region == 'D' ? 'INR' : 'USD'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment processing error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage(),
                'debug' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Initiate PayPal payment
     */
    private function initiatePayPalPayment($orderId, $pricing, $orderData)
    {
        // Get PayPal configuration
        $gateway = \DB::connection('mysql')->table('payment_gateways')
            ->where('keyword', 'paypal')
            ->where('is_active', 1)
            ->first();

        if (!$gateway) {
            throw new \Exception('PayPal gateway not configured');
        }

        $config = json_decode($gateway->information, true);
        
        // Return PayPal payment URL (you can integrate with PayPal SDK here)
        return route('payment.paypal.process', ['order' => $orderId]);
    }

    /**
     * Initiate Cashfree payment
     */
    private function initiateCashfreePayment($orderId, $pricing, $orderData)
    {
        // Get Cashfree configuration
        $gateway = \DB::connection('mysql')->table('payment_gateways')
            ->where('keyword', 'cashfree')
            ->where('is_active', 1)
            ->first();

        if (!$gateway) {
            throw new \Exception('Cashfree gateway not configured');
        }

        $config = json_decode($gateway->information, true);
        
        // Return Cashfree payment URL (you can integrate with Cashfree SDK here)
        return route('payment.cashfree.process', ['order' => $orderId]);
    }

    /**
     * Display checkout page for a product
     */
    public function checkout(Request $request, $productId = null)
    {
        // Get product ID from parameter or query string
        $productId = $productId ?? $request->get('product_id');
        $pricingId = $request->get('plan_id');
        
        if (!$productId) {
            return redirect()->route('products.showcase')->with('error', 'Please select a product first.');
        }
        
        $product = Product::where('id', $productId)
            ->where('is_active', true)
            ->with(['pricings' => function($query) {
                $query->orderBy('position');
            }])
            ->firstOrFail();
            
        // Get specific pricing if provided
        $pricing = null;
        if ($pricingId) {
            $pricing = $product->pricings->where('id', $pricingId)->first();
        } else {
            // Default to INR pricing first, then fallback to first available
            $pricing = $product->pricings->where('region', 'D')->first() 
                    ?? $product->pricings->first();
        }
        
        if (!$pricing) {
            return redirect()->route('products.show', $product->slug)
                ->with('error', 'Please select a valid pricing plan.');
        }
            
        // Pass all pricings for plan selection on checkout page
        return view('frontend.products.checkout', compact('product', 'pricing'));
    }

    /**
     * Generate payment URL based on gateway
     */
    private function generatePaymentUrl($checkoutId, $gateway)
    {
        switch (strtolower($gateway)) {
            case 'paypal':
                return route('paypal.create', ['checkout' => $checkoutId]);
            
            case 'stripe':
                return route('stripe.create', ['checkout' => $checkoutId]);
            
            case 'cashfree':
                return route('cashfree.create', ['checkout' => $checkoutId]);
            
            case 'phonepe':
                return route('phonepe.create', ['checkout' => $checkoutId]);
            
            case 'easebuzz':
                return route('easebuzz.create', ['checkout' => $checkoutId]);
            
            default:
                // Fallback to a generic payment success page for testing
                return route('payment.success') . '?gateway=' . $gateway . '&checkout=' . $checkoutId;
        }
    }

    /**
     * Get gateway description
     */
    private function getGatewayDescription($keyword)
    {
        $descriptions = [
            'cashfree' => 'Secure payments for Indian users with UPI, Cards, and Net Banking',
            'paypal' => 'International payment gateway for worldwide transactions',
            'stripe' => 'Global payment processing with card support',
            'phonepe' => 'UPI and digital payments for India',
            'easebuzz' => 'Complete payment solution for Indian businesses'
        ];

        return $descriptions[$keyword] ?? 'Secure payment processing';
    }
}




