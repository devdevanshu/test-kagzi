<?php

namespace App\Models\PaymentsGateway;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PayU extends Model
{
    use HasFactory;
    protected $table = 'payment_gateways';
    protected $fillable = [
        'name',
        'keyword',
        'information',
    ];

    protected $casts = [
        'information' => 'array',
    ];
}
