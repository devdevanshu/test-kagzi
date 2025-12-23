<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $table = 'payment_gateways';

    protected $fillable = [
        'name',
        'display_name',
        'keyword',
        'information',
        'config',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'information' => 'array',
        'config' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope to filter active gateways
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by keyword
     */
    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('keyword', $keyword);
    }

    /**
     * Get gateway configuration (information field for backward compatibility)
     */
    public function getConfigurationAttribute()
    {
        return $this->config ?? $this->information ?? [];
    }

    /**
     * Check if gateway is active
     */
    public function isActive(): bool
    {
        return $this->is_active === true || $this->is_active === 1;
    }
}
