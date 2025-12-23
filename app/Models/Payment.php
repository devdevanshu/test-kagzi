<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $table = 'payment_gateways';
    
    protected $fillable = [
        'name', 
        'keyword', 
        'information'
    ]; 

    protected $casts = [
        'information' => 'array'
    ];

    /**
     * Get checkouts that used this payment gateway
     */
    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'payment_method', 'keyword');
    }
}
