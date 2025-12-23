<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkout;
use App\Services\Payment\PayPalService;
use App\Services\Payment\PurchaseService;
use Illuminate\Http\Request;

class PayPalPaymentController extends Controller
{
    protected $paypalService;
    protected $purchaseService;

    public function __construct(PayPalService $paypalService, PurchaseService $purchaseService)
    {
        $this->paypalService = $paypalService;
        $this->purchaseService = $purchaseService;
    }

    /**
     * Create PayPal payment
     */
    public function create($checkoutId)
    {
        $checkout = Checkout::with(['product', 'pricing'])->findOrFail($checkoutId);
        
        try {
            $order = $this->paypalService->createOrder($checkout);
            
            if (isset($order['id'])) {
                // Store PayPal order ID
                $checkout->update(['transaction_id' => $order['id']]);
                
                // Redirect to PayPal for approval
                foreach ($order['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect($link['href']);
                    }
                }
            }
            
            return redirect()->route('payment.failure')->withErrors(['error' => 'Failed to create PayPal order']);
            
        } catch (\Exception $e) {
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle PayPal success callback
     */
    public function success(Request $request)
    {
        $orderId = $request->get('token');
        
        if (!$orderId) {
            return redirect()->route('payment.failure');
        }
        
        try {
            $checkout = Checkout::where('transaction_id', $orderId)->firstOrFail();
            
            // Capture the payment
            $result = $this->paypalService->captureOrder($orderId);
            
            if ($result['status'] === 'COMPLETED') {
                // Update checkout status
                $checkout->markAsSuccessful($orderId, $result);
                
                // Find and update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                    session(['purchase_id' => $purchase->id, 'checkout_id' => $checkout->id]);
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
                
                session(['checkout_id' => $checkout->id]);
                return redirect()->route('payment.failure');
            }
            
        } catch (\Exception $e) {
            \Log::error('PayPal payment success handling failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle PayPal cancel callback
     */
    public function cancel(Request $request)
    {
        $orderId = $request->get('token');
        
        if ($orderId) {
            $checkout = Checkout::where('transaction_id', $orderId)->first();
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




