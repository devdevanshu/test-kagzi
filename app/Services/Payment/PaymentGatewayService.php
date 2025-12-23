<?php

namespace App\Services\Payment;

use App\Models\PaymentGateway;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PaymentGatewayService
{
    /**
     * Get all active payment gateways
     */
    public function getActiveGateways(): Collection
    {
        return Cache::remember('active_payment_gateways', now()->addHours(1), function () {
            try {
                return PaymentGateway::where('is_active', true)
                                   ->orderBy('sort_order')
                                   ->get();
            } catch (\Exception $e) {
                Log::error('Failed to fetch payment gateways', ['error' => $e->getMessage()]);
                return collect([]);
            }
        });
    }

    /**
     * Get gateway configuration by keyword/name
     */
    public function getGatewayConfig(string $gatewayIdentifier): ?PaymentGateway
    {
        $cacheKey = "payment_gateway_{$gatewayIdentifier}";
        
        return Cache::remember($cacheKey, now()->addHours(1), function () use ($gatewayIdentifier) {
            try {
                // Try to find by keyword first, then by name
                $gateway = PaymentGateway::where('keyword', $gatewayIdentifier)
                                       ->where('is_active', true)
                                       ->first();
                
                if (!$gateway) {
                    $gateway = PaymentGateway::where('name', $gatewayIdentifier)
                                           ->where('is_active', true)
                                           ->first();
                }
                
                return $gateway;
            } catch (\Exception $e) {
                Log::error('Failed to fetch payment gateway config', [
                    'gateway' => $gatewayIdentifier,
                    'error' => $e->getMessage()
                ]);
                return null;
            }
        });
    }

    /**
     * Update gateway configuration
     */
    public function updateGatewayConfig(string $gatewayName, array $config): bool
    {
        try {
            $gateway = PaymentGateway::firstOrCreate(
                ['name' => $gatewayName],
                [
                    'display_name' => ucfirst($gatewayName),
                    'is_active' => false,
                    'sort_order' => 1
                ]
            );

            $gateway->update([
                'config' => $config,
                'is_active' => $config['is_active'] ?? false,
                'display_name' => $config['display_name'] ?? ucfirst($gatewayName),
                'sort_order' => $config['sort_order'] ?? $gateway->sort_order
            ]);

            // Clear cache
            $this->clearGatewayCache($gatewayName);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to update payment gateway config', [
                'gateway' => $gatewayName,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Clear gateway cache
     */
    public function clearGatewayCache(?string $gatewayName = null): void
    {
        Cache::forget('active_payment_gateways');
        
        if ($gatewayName) {
            Cache::forget("payment_gateway_{$gatewayName}");
        } else {
            // Clear all gateway caches
            $gateways = ['paypal', 'stripe', 'cashfree', 'phonepe', 'easebuzz', 'payu'];
            foreach ($gateways as $gateway) {
                Cache::forget("payment_gateway_{$gateway}");
            }
        }
    }

    /**
     * Get gateway credentials for payment processing
     */
    public function getGatewayCredentials(string $gatewayIdentifier): array
    {
        $gateway = $this->getGatewayConfig($gatewayIdentifier);
        
        if (!$gateway || !$gateway->information) {
            Log::warning('Gateway credentials not found', ['gateway' => $gatewayIdentifier]);
            return [];
        }

        // Return information array which contains the credentials
        return is_array($gateway->information) ? $gateway->information : json_decode($gateway->information, true) ?? [];
    }

    /**
     * Get specific gateway credential by key
     */
    public function getGatewayCredential(string $gatewayIdentifier, string $key, $default = null)
    {
        $credentials = $this->getGatewayCredentials($gatewayIdentifier);
        return $credentials[$key] ?? $default;
    }

    /**
     * Check if a gateway is configured and active
     */
    public function isGatewayActive(string $gatewayIdentifier): bool
    {
        $gateway = $this->getGatewayConfig($gatewayIdentifier);
        
        if (!$gateway) {
            return false;
        }
        
        // Check the is_active field first (new method)
        if (isset($gateway->is_active)) {
            return $gateway->is_active === true || $gateway->is_active === 1;
        }
        
        // Fallback to information.status for backward compatibility
        $information = is_array($gateway->information) ? $gateway->information : json_decode($gateway->information, true) ?? [];
        $status = $information['status'] ?? 'inactive';
        
        return strtolower($status) === 'active';
    }

    /**
     * Get supported payment methods for a gateway (Only Cashfree and PayPal)
     */
    public function getSupportedMethods(string $gatewayName): array
    {
        $gateway = $this->getGatewayConfig($gatewayName);
        
        if (!$gateway) {
            return [];
        }

        // Only support Cashfree and PayPal methods
        $supportedMethods = [
            'paypal' => ['paypal', 'credit_card'],
            'cashfree' => ['upi', 'netbanking', 'credit_card', 'debit_card', 'wallet'],
        ];

        return $supportedMethods[$gatewayName] ?? [];
    }

    /**
     * Check if gateway is supported (Only Cashfree and PayPal)
     */
    public function isGatewaySupported(string $gatewayName): bool
    {
        $supportedGateways = ['cashfree', 'paypal'];
        return in_array(strtolower($gatewayName), $supportedGateways);
    }
}
