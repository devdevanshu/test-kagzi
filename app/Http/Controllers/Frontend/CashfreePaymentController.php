<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkout;
use App\Services\Payment\CashfreeService;
use App\Services\Payment\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CashfreePaymentController extends Controller
{
    protected $cashfreeService;
    protected $purchaseService;

    public function __construct(CashfreeService $cashfreeService, PurchaseService $purchaseService)
    {
        $this->cashfreeService = $cashfreeService;
        $this->purchaseService = $purchaseService;
    }

    /**
     * Create Cashfree payment
     */
    public function create($checkoutId)
    {
        $checkout = Checkout::with(['product', 'pricing'])->findOrFail($checkoutId);
        
        try {
            Log::info('Starting Cashfree payment creation', [
                'checkout_id' => $checkoutId,
                'amount' => $checkout->amount ?? $checkout->pricing?->price,
                'currency' => $checkout->currency
            ]);

            // Create order with Cashfree
            $order = $this->cashfreeService->createOrder($checkout);
            
            if (isset($order['payment_session_id'])) {
                // New Cashfree API returns payment_session_id, show checkout page
                return $this->showCheckoutPage($checkout, $order);
            } else if (isset($order['payment_link'])) {
                // Direct payment link - redirect
                Log::info('Redirecting to Cashfree payment link', ['payment_link' => $order['payment_link']]);
                return redirect($order['payment_link']);
            } else {
                // Try to get payment link using order ID
                $paymentLink = $this->cashfreeService->getPaymentLink($order['order_id'] ?? $checkout->order_id);
                
                if ($paymentLink) {
                    Log::info('Redirecting to Cashfree payment link (from getPaymentLink)', ['payment_link' => $paymentLink]);
                    return redirect($paymentLink);
                } else {
                    // Show custom checkout page with Cashfree SDK
                    return $this->showCheckoutPage($checkout, $order);
                }
            }
            
        } catch (\Exception $e) {
            Log::error('Cashfree payment creation failed', [
                'checkout_id' => $checkoutId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show Cashfree checkout page with SDK integration
     */
    private function showCheckoutPage($checkout, $orderData)
    {
        return view('frontend.payment.cashfree-checkout', [
            'checkout' => $checkout,
            'order_data' => $orderData,
            'session_id' => $orderData['payment_session_id'] ?? null,
            'order_id' => $orderData['order_id'] ?? $checkout->order_id
        ]);
    }

    /**
     * Handle Cashfree callback (webhook)
     */
    public function callback(Request $request)
    {
        try {
            $data = $request->all();
            Log::info('Cashfree callback received', ['data' => $data]);
            
            // Handle the callback
            $result = $this->cashfreeService->handleCallback($data);
            
            $orderId = $result['order_id'];
            $status = $result['status'];
            
            // Find checkout by order ID
            $checkout = Checkout::where('transaction_id', $orderId)
                              ->orWhere('order_id', $orderId)
                              ->first();
            
            if (!$checkout) {
                Log::error('Checkout not found for Cashfree callback', ['order_id' => $orderId]);
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            // Update checkout and purchase based on status
            if (strtoupper($status) === 'PAID') {
                // Payment successful
                $checkout->markAsSuccessful($orderId, $result);
                
                // Find and update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                } else {
                    // Create purchase if it doesn't exist
                    $purchase = $this->purchaseService->createPurchase($checkout, $result);
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                }
                
            } else {
                // Payment failed or pending
                $checkout->markAsFailed($result);
                
                // Update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsFailed($purchase, $result);
                }
            }

            return response()->json(['status' => 'success'], 200);
            
        } catch (\Exception $e) {
            Log::error('Cashfree callback handling failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            return response()->json(['status' => 'error', 'message' => 'Callback processing failed'], 500);
        }
    }

    /**
     * Handle user return from Cashfree
     */
    public function return(Request $request)
    {
        $orderId = $request->get('order_id');
        
        if (!$orderId) {
            return redirect()->route('payment.failure');
        }
        
        try {
            // Verify payment status with Cashfree
            $result = $this->cashfreeService->verifyPayment($orderId);
            
            $checkout = Checkout::where('transaction_id', $orderId)
                              ->orWhere('order_id', $orderId)
                              ->first();
            
            if (!$checkout) {
                return redirect()->route('payment.failure');
            }

            if (strtoupper($result['status']) === 'PAID') {
                // Payment successful
                $checkout->markAsSuccessful($orderId, $result);
                
                // Find and update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                    session(['purchase_id' => $purchase->id, 'checkout_id' => $checkout->id]);
                } else {
                    // Create purchase if it doesn't exist
                    $purchase = $this->purchaseService->createPurchase($checkout, $result);
                    $this->purchaseService->markAsSuccessful($purchase, $result);
                    session(['purchase_id' => $purchase->id, 'checkout_id' => $checkout->id]);
                }
                
                return redirect()->route('payment.success');
            } else {
                // Payment failed
                $checkout->markAsFailed($result);
                
                // Update purchase record
                $purchase = $this->purchaseService->findByCheckout($checkout);
                if ($purchase) {
                    $this->purchaseService->markAsFailed($purchase, $result);
                }
                
                session(['checkout_id' => $checkout->id]);
                return redirect()->route('payment.failure');
            }
            
        } catch (\Exception $e) {
            Log::error('Cashfree return handling failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
        }
    }
}




