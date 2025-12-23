<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'plan_id',
        'name',
        'email',
        'phone_number',
        'payment_method',
        'purchase_date',
        'ip_address',
        'user_agent',
        'status',
        'pmt_response',
        'transaction_id',
        'order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function plan()
    {
        return $this->belongsTo(Pricing::class, 'plan_id');
    }
    
}
