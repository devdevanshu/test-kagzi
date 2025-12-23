<?php

namespace App\Models\PaymentsGateway;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class Cashfree extends Model
{
    use HasFactory;
    
    protected $table = 'payment_gateways'; 
    
    protected $fillable = [
        'name', 
        'keyword', 
        'information',
        'is_active',
    ];

    protected $casts = [
        'information' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get decrypted client secret
     */
    public function getClientSecret()
    {
        try {
            $info = $this->information;
            if (isset($info['client_secret'])) {
                return Crypt::decryptString($info['client_secret']);
            }
            return null;
        } catch (\Exception $e) {
            Log::error('Failed to decrypt Cashfree client secret', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Get client ID
     */
    public function getClientId()
    {
        $info = $this->information;
        return $info['client_id'] ?? null;
    }

    /**
     * Get environment
     */
    public function getEnvironment()
    {
        $info = $this->information;
        return $info['environment'] ?? 'sandbox';
    }

    /**
     * Check if gateway is properly configured
     */
    public function isConfigured()
    {
        return $this->is_active && 
               $this->getClientId() && 
               $this->getClientSecret();
    }

    /**
     * Get API URL based on environment
     */
    public function getApiUrl()
    {
        $environment = $this->getEnvironment();
        return $environment === 'production' 
            ? 'https://api.cashfree.com'
            : 'https://sandbox.cashfree.com';
    }
}
