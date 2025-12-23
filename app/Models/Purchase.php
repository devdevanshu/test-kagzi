<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'pricing_id',
        'transaction_id',
        'payment_gateway',
        'payment_method',
        'payment_status',
        'amount',
        'currency',
        'status',
        'payment_data',
        'user_details',
        'admin_notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_data' => 'array',
        'user_details' => 'array',
    ];

    /**
     * Get the user that owns the purchase
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that was purchased
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the pricing plan that was purchased
     */
    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class);
    }

    /**
     * Scope for successful purchases
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for failed purchases
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for pending purchases
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if purchase is successful
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if purchase is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if purchase failed
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Get formatted amount with currency
     */
    public function getFormattedAmountAttribute(): string
    {
        $symbol = $this->currency === 'USD' ? '$' : '₹';
        return $symbol . number_format($this->amount, 2);
    }

    /**
     * Get customer name (user or from user_details)
     */
    public function getCustomerNameAttribute(): string
    {
        return $this->user ? $this->user->name : ($this->user_details['name'] ?? 'Guest');
    }

    /**
     * Get customer email (user or from user_details)
     */
    public function getCustomerEmailAttribute(): string
    {
        return $this->user ? $this->user->email : ($this->user_details['email'] ?? '');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'completed' => 'badge-success',
            'pending' => 'badge-warning', 
            'failed' => 'badge-danger',
            'cancelled' => 'badge-secondary',
            'refunded' => 'badge-info',
            default => 'badge-secondary'
        };
    }

    /**
     * Get payment gateway display name
     */
    public function getPaymentGatewayDisplayAttribute(): string
    {
        return ucfirst($this->payment_gateway);
    }
}