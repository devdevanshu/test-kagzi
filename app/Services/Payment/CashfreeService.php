<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentGatewayService;
use App\Models\Checkout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CashfreeService
{
    protected $gatewayService;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct(PaymentGatewayService $gatewayService)
    {
        $this->gatewayService = $gatewayService;
        $this->initializeCredentials();
    }

    /**
     * Initialize Cashfree credentials from database
     */
    private function initializeCredentials()
    {
        // Get Cashfree credentials from admin panel
        $credentials = $this->gatewayService->getGatewayCredentials('cashfree');
        
        if (empty($credentials)) {
            Log::error('Cashfree gateway configuration not found in admin panel');
            throw new \Exception('Cashfree gateway configuration not found in admin panel. Please configure Cashfree in admin panel first.');
        }

        // Use app_id and secret_key (as stored in admin panel)
        $this->clientId = $credentials['app_id'] ?? null;
        $this->clientSecret = $this->decryptSecret($credentials['secret_key'] ?? null);
        
        // Log for debugging (without sensitive data)
        Log::info('Cashfree credentials loaded', [
            'app_id_present' => !empty($this->clientId),
            'secret_key_present' => !empty($this->clientSecret),
            'environment' => $credentials['environment'] ?? 'not_set'
        ]);
        
        if (empty($this->clientId) || empty($this->clientSecret)) {
            Log::error('Cashfree credentials missing', [
                'app_id' => empty($this->clientId) ? 'missing' : 'present',
                'secret_key' => empty($this->clientSecret) ? 'missing' : 'present'
            ]);
            throw new \Exception('Cashfree credentials (app_id or secret_key) not configured in admin panel');
        }
        
        // Determine environment
        $environment = $credentials['environment'] ?? 'sandbox';
        $this->baseUrl = ($environment === 'production') 
            ? 'https://api.cashfree.com' 
            : 'https://sandbox.cashfree.com';
            
        Log::info('Cashfree service initialized', [
            'environment' => $environment,
            'base_url' => $this->baseUrl
        ]);
    }

    /**
     * Decrypt client secret
     */
    private function decryptSecret($encryptedSecret)
    {
        if (!$encryptedSecret) {
            return null;
        }

        try {
            return \Illuminate\Support\Facades\Crypt::decryptString($encryptedSecret);
        } catch (\Exception $e) {
            // If decryption fails, assume it's already decrypted (backward compatibility)
            return $encryptedSecret;
        }
    }

    /**
     * Get access token for Cashfree API
     */
    public function getAccessToken()
    {
        try {
            $response = Http::withHeaders([
                'X-Client-Id' => $this->clientId,
                'X-Client-Secret' => $this->clientSecret,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/payout/v1/authorize');

            if ($response->successful()) {
                $data = $response->json();
                return $data['data']['token'] ?? null;
            }

            throw new \Exception('Failed to get Cashfree access token: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Cashfree access token failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Create Cashfree payment order
     */
    public function createOrder(Checkout $checkout)
    {
        try {
            $orderId = 'ORDER_' . $checkout->id . '_' . time();
            $amount = $checkout->amount ?? $checkout->pricing->price;
            $currency = $checkout->currency ?? ($checkout->pricing->region === 'I' ? 'INR' : 'USD');

            $orderData = [
                'order_id' => $orderId,
                'order_amount' => (float) $amount,
                'order_currency' => $currency,
                'customer_details' => [
                    'customer_id' => 'CUST_' . $checkout->id,
                    'customer_name' => $checkout->name,
                    'customer_email' => $checkout->email,
                    'customer_phone' => $checkout->phone_number,
                ],
                'order_meta' => [
                    'return_url' => route('payment.cashfree.return', ['order_id' => $orderId]),
                    'notify_url' => route('payment.cashfree.callback'),
                ]
            ];

            Log::info('Creating Cashfree order', [
                'order_id' => $orderId,
                'amount' => $amount,
                'currency' => $currency,
                'api_url' => $this->baseUrl . '/pg/orders'
            ]);

            $response = Http::withHeaders([
                'X-Client-Id' => $this->clientId,
                'X-Client-Secret' => $this->clientSecret,
                'Content-Type' => 'application/json',
                'x-api-version' => '2023-08-01',
            ])->post($this->baseUrl . '/pg/orders', $orderData);

            Log::info('Cashfree API response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                
                // Update checkout with Cashfree order ID
                $checkout->update([
                    'transaction_id' => $orderId,
                    'order_id' => $responseData['order_id'] ?? $orderId,
                ]);

                Log::info('Cashfree order created successfully', [
                    'checkout_id' => $checkout->id,
                    'order_id' => $orderId,
                    'cf_order_id' => $responseData['order_id'] ?? null
                ]);

                return $responseData;
            }

            $errorBody = $response->body();
            Log::error('Cashfree order creation failed', [
                'status' => $response->status(),
                'response' => $errorBody
            ]);
            
            throw new \Exception('Failed to create Cashfree order. API Error: ' . $errorBody);

        } catch (\Exception $e) {
            Log::error('Cashfree order creation exception', [
                'checkout_id' => $checkout->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Get payment link for Cashfree order
     */
    public function getPaymentLink($orderId)
    {
        try {
            // First, get the order details to extract payment session ID
            $response = Http::withHeaders([
                'X-Client-Id' => $this->clientId,
                'X-Client-Secret' => $this->clientSecret,
                'Content-Type' => 'application/json',
                'x-api-version' => '2023-08-01',
            ])->get($this->baseUrl . "/pg/orders/{$orderId}");

            if ($response->successful()) {
                $data = $response->json();
                
                // If order has payment_session_id, construct the hosted checkout URL
                if (isset($data['payment_session_id'])) {
                    $sessionId = $data['payment_session_id'];
                    $environment = strpos($this->baseUrl, 'sandbox') !== false ? 'test' : 'prod';
                    return "https://payments{$environment}.cashfree.com/pay/{$sessionId}";
                }
                
                // Fallback: try to create payment session
                return $this->createPaymentSession($orderId);
            }

            throw new \Exception('Failed to get Cashfree order details: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('Cashfree payment link failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Create payment session for hosted checkout
     */
    private function createPaymentSession($orderId)
    {
        try {
            $response = Http::withHeaders([
                'X-Client-Id' => $this->clientId,
                'X-Client-Secret' => $this->clientSecret,
                'Content-Type' => 'application/json',
                'x-api-version' => '2023-08-01',
            ])->post($this->baseUrl . "/pg/orders/{$orderId}/payments");

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['payment_session_id'])) {
                    $sessionId = $data['payment_session_id'];
                    $environment = strpos($this->baseUrl, 'sandbox') !== false ? '-test' : '';
                    return "https://payments{$environment}.cashfree.com/pay/{$sessionId}";
                }
                
                return $data['payment_url'] ?? null;
            }

            Log::error('Failed to create Cashfree payment session', [
                'order_id' => $orderId,
                'response' => $response->body()
            ]);
            
            return null;

        } catch (\Exception $e) {
            Log::error('Cashfree payment session creation failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Verify payment status
     */
    public function verifyPayment($orderId)
    {
        try {
            $response = Http::withHeaders([
                'X-Client-Id' => $this->clientId,
                'X-Client-Secret' => $this->clientSecret,
                'Content-Type' => 'application/json',
                'x-api-version' => '2023-08-01',
            ])->get($this->baseUrl . "/pg/orders/{$orderId}");

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'status' => $data['order_status'] ?? 'PENDING',
                    'transaction_id' => $data['cf_order_id'] ?? null,
                    'payment_method' => $data['order_meta']['payment_methods'] ?? 'cashfree',
                    'amount' => $data['order_amount'] ?? 0,
                    'currency' => $data['order_currency'] ?? 'INR',
                    'raw_response' => $data,
                ];
            }

            throw new \Exception('Failed to verify Cashfree payment: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('Cashfree payment verification failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Handle Cashfree webhook/callback
     */
    public function handleCallback(array $data)
    {
        try {
            $orderId = $data['order_id'] ?? null;
            $status = $data['order_status'] ?? 'FAILED';
            
            if (!$orderId) {
                throw new \Exception('Order ID missing in Cashfree callback');
            }

            // Verify the callback signature if needed
            // $this->verifySignature($data);

            return [
                'order_id' => $orderId,
                'status' => $status,
                'transaction_id' => $data['cf_order_id'] ?? null,
                'payment_method' => 'cashfree',
                'callback_data' => $data,
            ];

        } catch (\Exception $e) {
            Log::error('Cashfree callback handling failed', [
                'data' => $data,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
