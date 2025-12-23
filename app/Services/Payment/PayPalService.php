<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentGatewayService;
use App\Models\Checkout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayPalService
{
    protected $gatewayService;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct(PaymentGatewayService $gatewayService)
    {
        $this->gatewayService = $gatewayService;
        
        // Get PayPal credentials from admin panel
        $credentials = $this->gatewayService->getGatewayCredentials('paypal');
        
        if (empty($credentials)) {
            throw new \Exception('PayPal gateway configuration not found in admin panel');
        }

        $this->clientId = $credentials['client_id'] ?? null;
        $this->clientSecret = $credentials['client_secret'] ?? null;
        
        if (empty($this->clientId) || empty($this->clientSecret)) {
            throw new \Exception('PayPal credentials (client_id or client_secret) not configured in admin panel');
        }
        
        // Determine sandbox mode
        $isSandbox = $credentials['mode'] ?? 'sandbox';
        $this->baseUrl = ($isSandbox === 'sandbox') 
            ? 'https://api-m.sandbox.paypal.com' 
            : 'https://api-m.paypal.com';
    }

    /**
     * Get OAuth access token
     */
    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->asForm()
            ->post($this->baseUrl . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Failed to get PayPal access token: ' . $response->body());
    }

    /**
     * Create PayPal order
     */
    public function createOrder(Checkout $checkout)
    {
        $accessToken = $this->getAccessToken();
        
        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $checkout->order_id,
                    'amount' => [
                        'currency_code' => $checkout->pricing->region === 'I' ? 'USD' : 'INR',
                        'value' => number_format($checkout->pricing->price, 2, '.', ''),
                    ],
                    'description' => $checkout->product->name . ' - ' . $checkout->pricing->title,
                ]
            ],
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
                'brand_name' => config('app.name'),
                'user_action' => 'PAY_NOW',
            ]
        ];

        $response = Http::withToken($accessToken)
            ->post($this->baseUrl . '/v2/checkout/orders', $orderData);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('PayPal order creation failed', [
            'checkout_id' => $checkout->id,
            'response' => $response->body(),
        ]);

        throw new \Exception('Failed to create PayPal order: ' . $response->body());
    }

    /**
     * Capture PayPal order
     */
    public function captureOrder($orderId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->post($this->baseUrl . '/v2/checkout/orders/' . $orderId . '/capture');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to capture PayPal order: ' . $response->body());
    }

    /**
     * Get order details
     */
    public function getOrderDetails($orderId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->get($this->baseUrl . '/v2/checkout/orders/' . $orderId);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to get PayPal order details: ' . $response->body());
    }
}
