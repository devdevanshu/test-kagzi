<?php

namespace App\Services\Payment;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductSyncService
{
    /**
     * Get all active products with caching
     */
    public function getActiveProducts(bool $useCache = true): Collection
    {
        if (!$useCache) {
            return $this->fetchActiveProducts();
        }

        return Cache::remember('active_products', now()->addMinutes(5), function () {
            return $this->fetchActiveProducts();
        });
    }

    /**
     * Fetch active products from database
     */
    private function fetchActiveProducts(): Collection
    {
        try {
            return Product::with(['pricings'])
                         ->active()
                         ->orderBy('created_at', 'desc')
                         ->get();
        } catch (\Exception $e) {
            Log::error('Failed to fetch products', ['error' => $e->getMessage()]);
            return collect([]);
        }
    }

    /**
     * Get a single product by slug
     */
    public function getProductBySlug(string $slug): ?Product
    {
        $cacheKey = 'product_' . $slug;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($slug) {
            try {
                return Product::with(['pricings'])
                             ->active()
                             ->where('slug', $slug)
                             ->first();
            } catch (\Exception $e) {
                Log::error('Failed to fetch product', ['slug' => $slug, 'error' => $e->getMessage()]);
                return null;
            }
        });
    }

    /**
     * Clear product cache
     */
    public function clearProductCache(): void
    {
        Cache::forget('active_products');
        
        // Clear individual product caches (this is a simple approach)
        // In a production environment, you might want to use cache tags
        $products = Product::select('slug')->get();
        foreach ($products as $product) {
            Cache::forget('product_' . $product->slug);
        }
    }

    /**
     * Get products for dashboard display
     */
    public function getDashboardProducts(int $limit = 6): Collection
    {
        return Cache::remember('dashboard_products', now()->addMinutes(5), function () use ($limit) {
            try {
                return Product::with(['pricings'])
                             ->active()
                             ->latest()
                             ->take($limit)
                             ->get();
            } catch (\Exception $e) {
                Log::error('Failed to fetch dashboard products', ['error' => $e->getMessage()]);
                return collect([]);
            }
        });
    }

    /**
     * Get product statistics
     */
    public function getProductStats(): array
    {
        return Cache::remember('product_stats', now()->addMinutes(30), function () {
            try {
                return [
                    'total_active' => Product::active()->count(),
                    'total_products' => Product::count(),
                    'latest_product' => Product::active()->latest()->first(),
                ];
            } catch (\Exception $e) {
                Log::error('Failed to fetch product stats', ['error' => $e->getMessage()]);
                return [
                    'total_active' => 0,
                    'total_products' => 0,
                    'latest_product' => null,
                ];
            }
        });
    }
}
