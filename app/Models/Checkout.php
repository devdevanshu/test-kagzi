<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'product_id',
        'plan_id',
        'payment_method',
        'status',
        'ip_address',
        'user_agent',
        'order_id',
        'transaction_id',
        'payment_data',
    ];

    protected $casts = [
        'payment_data' => 'array',
    ];

    /**
     * Get the product associated with this checkout
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the pricing plan associated with this checkout
     */
    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class, 'plan_id');
    }

    /**
     * Mark checkout as successful
     */
    public function markAsSuccessful($transactionId, $paymentData = [])
    {
        $this->update([
            'status' => 'completed',
            'transaction_id' => $transactionId,
            'payment_data' => $paymentData,
        ]);
    }

    /**
     * Mark checkout as failed
     */
    public function markAsFailed($paymentData = [])
    {
        $this->update([
            'status' => 'failed',
            'payment_data' => $paymentData,
        ]);
    }

    /**
     * Mark checkout as pending
     */
    public function markAsPending()
    {
        $this->update([
            'status' => 'pending',
        ]);
    }
}
