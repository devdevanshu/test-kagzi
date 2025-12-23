<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkout;
use App\Services\Payment\StripeService;
use App\Services\Payment\PurchaseService;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    protected $stripeService;
    protected $purchaseService;

    public function __construct(StripeService $stripeService, PurchaseService $purchaseService)
    {
        $this->stripeService = $stripeService;
        $this->purchaseService = $purchaseService;
    }

    /**
     * Create Stripe payment session
     */
    public function create($checkoutId)
    {
        $checkout = Checkout::with(['product', 'pricing'])->findOrFail($checkoutId);
        
        try {
            $session = $this->stripeService->createCheckoutSession($checkout);
            
            if ($session->id) {
                // Store Stripe session ID
                $checkout->update(['transaction_id' => $session->id]);
                
                // Redirect to Stripe checkout
                return redirect($session->url);
            }
            
            return redirect()->route('payment.failure')->withErrors(['error' => 'Failed to create Stripe checkout session']);
            
        } catch (\Exception $e) {
            \Log::error('Stripe payment creation failed', [
                'checkout_id' => $checkoutId,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle Stripe success callback
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('payment.failure');
        }
        
        try {
            $checkout = Checkout::where('transaction_id', $sessionId)->firstOrFail();
            
            // Verify payment with Stripe
            $result = $this->stripeService->verifyPayment($sessionId);
            
            if ($result['status'] === 'complete') {
                // Update checkout status
                $checkout->markAsSuccessful($sessionId, $result);
                
                // Find and update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                    session(['purchase_id' => $purchase->id]);
                }
                
                return redirect()->route('payment.success');
            } else {
                // Update checkout as failed
                $checkout->markAsFailed($result);
                
                // Find and update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsFailed($purchase, $result);
                }
                
                return redirect()->route('payment.failure');
            }
            
        } catch (\Exception $e) {
            \Log::error('Stripe payment success handling failed', [
                'session_id' => $sessionId,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle Stripe cancel callback
     */
    public function cancel(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if ($sessionId) {
            $checkout = Checkout::where('transaction_id', $sessionId)->first();
            if ($checkout) {
                $checkout->markAsFailed(['status' => 'cancelled']);
                
                // Update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->updatePurchaseStatus($purchase, 'cancelled', ['status' => 'cancelled']);
                }
            }
        }
        
        return redirect()->route('payment.failure');
    }
}




