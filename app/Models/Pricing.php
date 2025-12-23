<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'region',
        'title',
        'price',
        'type',
        'type_value',
        'position'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'plan_id');
    }
}
