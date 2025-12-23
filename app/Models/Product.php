<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'is_active',
        'sku',
        'product_type',
        'credit_value',
        'meta_title',
        'meta_description',
        'project_url',
    ];
    
    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean'
    ];
    
    // Automatically generate slug when creating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });
    }
    
    // Generate unique slug
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;
        
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    // Get the first image or a default image
    public function getFirstImageAttribute()
    {
        if (!empty($this->images) && is_array($this->images)) {
            return asset('storage/' . $this->images[0]);
        }
        return asset('images/no-image.png'); // Default image
    }
    
    // Get all images with full URLs
    public function getImageUrlsAttribute()
    {
        if (!empty($this->images) && is_array($this->images)) {
            return array_map(function ($image) {
                return asset('storage/' . $image);
            }, $this->images);
        }
        return [];
    }
    
    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relationship to pricing plans
    public function pricings()
    {
        return $this->hasMany(Pricing::class)->orderBy('position');
    }

    // Relationship to checkouts (subscriptions)
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    /**
     * Get subscriptions for this product
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get payments for this product
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the primary image URL
     */
    public function getPrimaryImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }
        return asset('images/default-product.png');
    }

    /**
     * Get minimum price from all pricing plans
     */
    public function getMinPriceAttribute()
    {
        return $this->pricings()->min('price') ?? 0;
    }

    /**
     * Get maximum price from all pricing plans
     */
    public function getMaxPriceAttribute()
    {
        return $this->pricings()->max('price') ?? 0;
    }

    /**
     * Get domestic pricing (INR)
     */
    public function domesticPricings()
    {
        return $this->pricings()->where('region', 'D');
    }

    /**
     * Get international pricing (USD)
     */
    public function internationalPricings()
    {
        return $this->pricings()->where('region', 'I');
    }

    /**
     * Get total sales count
     */
    public function getTotalSalesAttribute()
    {
        return $this->purchases()->where('status', 'completed')->count();
    }

    /**
     * Get total revenue
     */
    public function getTotalRevenueAttribute()
    {
        return $this->purchases()->where('status', 'completed')->sum('amount');
    }
}


