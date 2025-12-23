<?php

namespace App\Http\Controllers\PaymentsGateway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class BaseGatewayController extends Controller
{
    /**
     * Update gateway configuration with proper is_active handling
     */
    protected function updateGatewayConfig(
        string $keyword,
        array $validated,
        string $statusField = 'status',
        array $encryptFields = ['client_secret', 'secret_key']
    ) {
        try {
            // Convert status to boolean for is_active field
            $isActive = ($validated[$statusField] === 'active');

            // Find or create gateway record
            $gateway = DB::table('payment_gateways')
                        ->where('keyword', $keyword)
                        ->first();

            $information = [];
            
            // Prepare information array, encrypting sensitive fields
            foreach ($validated as $key => $value) {
                if ($key === 'card_title' || $key === $statusField) {
                    // Skip these as they go into separate fields
                    continue;
                }
                
                if (in_array($key, $encryptFields) && !empty($value)) {
                    // Encrypt sensitive data
                    $information[$key] = Crypt::encryptString($value);
                } else {
                    $information[$key] = $value;
                }
            }
            
            // Keep status in information for backward compatibility
            $information[$statusField] = $validated[$statusField];

            if ($gateway) {
                // Update existing gateway
                DB::table('payment_gateways')
                    ->where('id', $gateway->id)
                    ->update([
                        'name' => $validated['card_title'],
                        'is_active' => $isActive,
                        'information' => json_encode($information),
                        'updated_at' => now(),
                    ]);
            } else {
                // Create new gateway
                DB::table('payment_gateways')->insert([
                    'name' => $validated['card_title'],
                    'keyword' => $keyword,
                    'is_active' => $isActive,
                    'information' => json_encode($information),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Clear cache to ensure updated config is loaded
            Cache::forget("payment_gateway_{$keyword}");
            Cache::forget('active_payment_gateways');

            Log::info("Gateway '{$keyword}' updated successfully", [
                'gateway' => $keyword,
                'is_active' => $isActive,
                'name' => $validated['card_title']
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error("Failed to update gateway '{$keyword}'", [
                'gateway' => $keyword,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }

    /**
     * Get gateway configuration with decrypted sensitive fields
     */
    protected function getGatewayConfig(string $keyword, array $decryptFields = ['client_secret', 'secret_key'])
    {
        try {
            $gateway = DB::table('payment_gateways')
                        ->where('keyword', $keyword)
                        ->first();

            if (!$gateway) {
                return null;
            }

            $information = json_decode($gateway->information, true) ?? [];
            
            // Decrypt sensitive fields
            foreach ($decryptFields as $field) {
                if (isset($information[$field]) && !empty($information[$field])) {
                    try {
                        $information[$field] = Crypt::decryptString($information[$field]);
                    } catch (\Exception $e) {
                        // If decryption fails, assume it's already decrypted (backward compatibility)
                        Log::warning("Failed to decrypt {$field} for {$keyword}, using as-is");
                    }
                }
            }

            return (object) [
                'id' => $gateway->id,
                'name' => $gateway->name,
                'keyword' => $gateway->keyword,
                'is_active' => $gateway->is_active,
                'information' => $information,
                'created_at' => $gateway->created_at,
                'updated_at' => $gateway->updated_at,
            ];

        } catch (\Exception $e) {
            Log::error("Failed to get gateway config for '{$keyword}'", [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Test gateway configuration
     */
    protected function testGatewayConfig(string $keyword, array $requiredFields = [])
    {
        try {
            $gateway = $this->getGatewayConfig($keyword);
            
            if (!$gateway) {
                return [
                    'success' => false,
                    'message' => ucfirst($keyword) . ' gateway not configured'
                ];
            }

            if (!$gateway->is_active) {
                return [
                    'success' => false,
                    'message' => ucfirst($keyword) . ' gateway is inactive'
                ];
            }

            // Check required fields
            foreach ($requiredFields as $field) {
                if (empty($gateway->information[$field])) {
                    return [
                        'success' => false,
                        'message' => "Required field '{$field}' is missing for " . ucfirst($keyword)
                    ];
                }
            }

            return [
                'success' => true,
                'message' => ucfirst($keyword) . ' configuration is valid',
                'gateway' => $gateway
            ];

        } catch (\Exception $e) {
            Log::error("Gateway test failed for '{$keyword}'", [
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to test ' . ucfirst($keyword) . ' configuration'
            ];
        }
    }
}