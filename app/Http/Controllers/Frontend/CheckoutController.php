<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkout;
use App\Models\Product;
use App\Models\Pricing;
use App\Models\PaymentGateway;
use App\Models\Purchase;
use App\Services\Payment\PurchaseService;
use App\Services\Payment\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected $purchaseService;
    protected $gatewayService;

    public function __construct(PurchaseService $purchaseService, PaymentGatewayService $gatewayService)
    {
        $this->purchaseService = $purchaseService;
        $this->gatewayService = $gatewayService;
    }

    /**
     * Process checkout form submission
     */
    public function testCheckout(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'product_id' => 'required|exists:products,id',
            'plan_id' => 'required|exists:pricings,id',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Normalize phone number with country code
        $phoneNumber = $this->normalizePhoneNumber($request->phone_number);

        // Create checkout record
        $checkout = Checkout::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $phoneNumber,
            'product_id' => $request->product_id,
            'plan_id' => $request->plan_id,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'order_id' => 'ORDER_' . time() . '_' . rand(1000, 9999),
        ]);

        // Store checkout ID in session for tracking
        session(['checkout_id' => $checkout->id]);

        // Route to appropriate payment gateway
        return $this->routeToPaymentGateway($checkout, $request->payment_method);
    }

    /**
     * Normalize phone number with country code
     */
    private function normalizePhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Add country code if not present
        if (strlen($phone) == 10 && substr($phone, 0, 2) !== '91') {
            $phone = '91' . $phone;
        }
        
        return '+' . $phone;
    }

    /**
     * Route to appropriate payment gateway
     */
    private function routeToPaymentGateway($checkout, $paymentMethod)
    {
        // Check if payment gateway is active and configured
        if (!$this->gatewayService->isGatewayActive($paymentMethod)) {
            return back()->withErrors(['payment_method' => ucfirst($paymentMethod) . ' payment gateway is not available or not configured in admin panel']);
        }

        // Create purchase record before redirecting to payment
        try {
            $purchase = $this->purchaseService->createPurchase($checkout);
            
            // Store purchase ID in session for tracking
            session(['purchase_id' => $purchase->id]);
            
        } catch (\Exception $e) {
            \Log::error('Failed to create purchase record during checkout', [
                'checkout_id' => $checkout->id,
                'error' => $e->getMessage()
            ]);
            return back()->withErrors(['payment_method' => 'Failed to initialize payment. Please try again.']);
        }

        // Route to appropriate gateway - Only Cashfree and PayPal allowed
        switch (strtolower($paymentMethod)) {
            case 'cashfree':
                return redirect()->route('payment.cashfree.create', ['checkout' => $checkout->id]);
            case 'paypal':
                return redirect()->route('payment.paypal.create', ['checkout' => $checkout->id]);
            // Disabled payment gateways - commented out
            // case 'stripe':
            //     return redirect()->route('stripe.create', ['checkout' => $checkout->id]);
            // case 'phonepe':
            //     return redirect()->route('phonepe.create', ['checkout' => $checkout->id]);
            // case 'easebuzz':
            //     return redirect()->route('easebuzz.create', ['checkout' => $checkout->id]);
            default:
                return back()->withErrors(['payment_method' => 'Invalid payment method selected. Only Cashfree and PayPal are supported.']);
        }
    }

    /**
     * Show payment success page
     */
    public function paymentSuccess(Request $request)
    {
        $checkoutId = session('checkout_id');
        $purchaseId = session('purchase_id');
        
        $checkout = null;
        $purchase = null;
        
        if ($checkoutId) {
            $checkout = Checkout::with(['product', 'pricing'])->find($checkoutId);
        }
        
        if ($purchaseId) {
            $purchase = Purchase::with(['user', 'product', 'pricing'])->find($purchaseId);
        }
        
        // Clear session data
        session()->forget(['checkout_id', 'purchase_id']);
        
        return view('frontend.payment.success', compact('checkout', 'purchase'));
    }

    /**
     * Show payment failure page
     */
    public function paymentFailure(Request $request)
    {
        $checkoutId = session('checkout_id');
        $purchaseId = session('purchase_id');
        
        $checkout = null;
        $purchase = null;
        
        if ($checkoutId) {
            $checkout = Checkout::with(['product', 'pricing'])->find($checkoutId);
        }
        
        if ($purchaseId) {
            $purchase = Purchase::with(['user', 'product', 'pricing'])->find($purchaseId);
        }
        
        // Clear session data
        session()->forget(['checkout_id', 'purchase_id']);
        
        return view('frontend.payment.failure', compact('checkout', 'purchase'));
    }
}




