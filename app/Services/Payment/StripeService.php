<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentGatewayService;
use App\Models\Checkout;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService
{
    protected $gatewayService;

    public function __construct(PaymentGatewayService $gatewayService)
    {
        $this->gatewayService = $gatewayService;
        
        // Get Stripe credentials from admin panel
        $credentials = $this->gatewayService->getGatewayCredentials('stripe');
        
        if (empty($credentials)) {
            throw new \Exception('Stripe gateway configuration not found in admin panel');
        }

        $secretKey = $credentials['secret_key'] ?? null;
        if (empty($secretKey)) {
            throw new \Exception('Stripe secret key not configured in admin panel');
        }

        Stripe::setApiKey($secretKey);
    }

    /**
     * Create Stripe checkout session
     */
    public function createCheckoutSession(Checkout $checkout)
    {
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $checkout->pricing->region === 'I' ? 'usd' : 'inr',
                            'product_data' => [
                                'name' => $checkout->product->name,
                                'description' => $checkout->pricing->title,
                            ],
                            'unit_amount' => $checkout->pricing->price * 100, // Convert to cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
                'client_reference_id' => $checkout->id,
                'metadata' => [
                    'checkout_id' => $checkout->id,
                    'order_id' => $checkout->order_id,
                ],
            ]);

            return $session;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Stripe session: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve Stripe session
     */
    public function retrieveSession($sessionId)
    {
        try {
            return Session::retrieve($sessionId);
        } catch (\Exception $e) {
            throw new \Exception('Failed to retrieve Stripe session: ' . $e->getMessage());
        }
    }

    /**
     * Verify payment status
     */
    public function verifyPayment($sessionId)
    {
        try {
            $session = $this->retrieveSession($sessionId);
            
            return [
                'status' => $session->status,
                'payment_status' => $session->payment_status,
                'amount_total' => $session->amount_total,
                'currency' => $session->currency,
                'customer' => $session->customer_details,
                'payment_intent' => $session->payment_intent,
                'session_data' => $session->toArray(),
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to verify Stripe payment: ' . $e->getMessage());
        }
    }
}
