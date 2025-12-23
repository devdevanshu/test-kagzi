<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Purchase;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    /**
     * Display purchase/subscription management page
     */
    public function index(Request $request)
    {
        try {
            // Optimize: Use database indexes and eager loading for better performance
            $query = Purchase::with(['user:id,name,email', 'product:id,name', 'pricing:id,name,price'])
                           ->select('id', 'user_id', 'product_id', 'pricing_id', 'transaction_id', 'payment_gateway', 'payment_method', 'amount', 'currency', 'status', 'user_details', 'created_at');
            
            // Apply filters
            $this->applyFilters($query, $request);
            
            // Order by latest first and paginate immediately for better performance
            $subscriptions = $query->orderBy('created_at', 'desc')
                                  ->paginate(15);
            
            // Convert to array format for consistent display
            $subscriptions->getCollection()->transform(function($purchase) {
                return $this->formatPurchaseData($purchase);
            });
            
            // Calculate statistics efficiently with cached results
            $cacheKey = 'subscription_stats_' . now()->format('Y-m-d-H');
            $statistics = \Illuminate\Support\Facades\Cache::remember($cacheKey, 1800, function() { // 30 min cache
                return $this->calculateLocalStatistics();
            });
            
            // Extract variables for backward compatibility with view
            $activeSubscriptions = $statistics['successful_purchases'] ?? 0;
            $pendingSubscriptions = $statistics['pending_purchases'] ?? 0;
            $totalRevenue = $statistics['total_revenue'] ?? 0;
            
            return view('subscriptions.index', compact('subscriptions', 'statistics', 'activeSubscriptions', 'pendingSubscriptions', 'totalRevenue'));
            
        } catch (\Exception $e) {
            Log::error('Failed to load subscription management', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Minimal fallback without complex relationships
            $subscriptions = Purchase::orderBy('created_at', 'desc')
                                ->paginate(15);
            $statistics = ['successful_purchases' => 0, 'pending_purchases' => 0, 'total_revenue' => 0];
            
            $activeSubscriptions = 0;
            $pendingSubscriptions = 0;
            $totalRevenue = 0;
            
            return view('subscriptions.index', compact('subscriptions', 'statistics', 'activeSubscriptions', 'pendingSubscriptions', 'totalRevenue'))
                   ->with('error', 'Unable to load subscription data. Please try again.');
        }
    }

    /**
     * Show detailed purchase information
     */
    public function show($id)
    {
        try {
            // Try to find locally first
            $purchase = Purchase::with(['user', 'product', 'pricing'])->find($id);
            
            if (!$purchase) {
                // Try to fetch from JobAway API
                $response = Http::timeout(10)->get(config('jobaway.api_url') . "/api/v1/purchases/{$id}");
                
                if ($response->successful()) {
                    $subscription = $response->json('data');
                    $subscription['source'] = 'api';
                    return view('subscriptions.show', compact('subscription'));
                } else {
                    abort(404, 'Purchase not found');
                }
            }
            
            // Convert local purchase to subscription array format
            $subscription = $this->formatPurchaseData($purchase);
            $subscription['source'] = 'local';
            
            return view('subscriptions.show', compact('subscription'));
            
        } catch (\Exception $e) {
            Log::error('Failed to show purchase details', [
                'purchase_id' => $id,
                'error' => $e->getMessage()
            ]);
            abort(404, 'Purchase not found');
        }
    }

    /**
     * Show edit form for subscription
     */
    public function edit($id)
    {
        try {
            // Try to find in local database first
            $purchase = Purchase::with(['user', 'product', 'pricing'])->find($id);
            
            if (!$purchase) {
                // Try to get from API
                $response = Http::timeout(10)->get(config('jobaway.api_url') . '/api/v1/purchases/' . $id);
                
                if ($response->successful()) {
                    $subscription = $response->json('data');
                    $subscription['source'] = 'api';
                    return view('subscriptions.edit', compact('subscription'));
                } else {
                    abort(404, 'Purchase not found');
                }
            }
            
            // Convert local purchase to subscription array format
            $subscription = $this->formatPurchaseData($purchase);
            $subscription['source'] = 'local';
            
            return view('subscriptions.edit', compact('subscription'));
            
        } catch (\Exception $e) {
            Log::error('Failed to load edit form', [
                'purchase_id' => $id,
                'error' => $e->getMessage()
            ]);
            abort(404, 'Purchase not found');
        }
    }

    /**
     * Update subscription
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'transaction_id' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive,cancelled,expired',
                'amount' => 'required|numeric|min:0',
                'user_id' => 'required|integer|min:1',
                'product_id' => 'required|integer|min:1',
                'pricing_id' => 'required|integer|min:1',
                'payment_method' => 'nullable|string',
                'payment_status' => 'nullable|in:pending,processing,completed,failed,refunded',
                'notes' => 'nullable|string'
            ]);

            // Try to update in local database
            $purchase = Purchase::find($id);
            
            if ($purchase) {
                // Get existing payment_data or create new array
                $paymentData = is_array($purchase->payment_data) ? $purchase->payment_data : [];
                
                // Merge new payment data - save payment_status and payment_method to JSON
                if ($request->payment_status) {
                    $paymentData['payment_status'] = $request->payment_status;
                }
                if ($request->payment_method) {
                    $paymentData['payment_method'] = $request->payment_method;
                }
                $paymentData['admin_notes'] = $request->notes ?? '';
                
                $purchase->update([
                    'transaction_id' => $request->transaction_id,
                    'status' => $request->status,
                    'amount' => $request->amount,
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'pricing_id' => $request->pricing_id,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                    'payment_data' => $paymentData,
                    'admin_notes' => $request->notes
                ]);
                
                return redirect()->route('subscription.show', $id)
                    ->with('success', 'Subscription updated successfully');
            }
            
            return redirect()->route('subscription.index')
                ->with('error', 'Purchase not found in local database');
            
        } catch (\Exception $e) {
            Log::error('Failed to update purchase', [
                'purchase_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('subscription.index')
                ->with('error', 'Failed to update subscription');
        }
    }

    /**
     * Delete subscription
     */
    public function destroy($id)
    {
        try {
            $purchase = Purchase::find($id);
            
            if ($purchase) {
                $purchase->delete();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Subscription deleted successfully'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Purchase not found'
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Failed to delete purchase', [
                'purchase_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete subscription'
            ], 500);
        }
    }

    /**
     * Get local purchases with pagination (optimized)
     */
    private function getLocalPurchases(Request $request, $perPage = 15)
    {
        $query = Purchase::with(['user:id,name,email', 'product:id,name', 'pricing:id,name,price'])
                        ->select('id', 'user_id', 'product_id', 'pricing_id', 'transaction_id', 'payment_gateway', 'payment_method', 'amount', 'currency', 'status', 'user_details', 'created_at');
        
        // Apply filters
        $this->applyFilters($query, $request);
        
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get purchases from JobAway API
     */
    private function getJobAwayPurchases(Request $request)
    {
        try {
            $params = [];
            
            // Apply same filters for API call
            if ($request->has('search')) {
                $params['search'] = $request->search;
            }
            
            if ($request->has('status')) {
                $params['status'] = $request->status;
            }
            
            if ($request->has('payment_gateway')) {
                $params['payment_gateway'] = $request->payment_gateway;
            }
            
            if ($request->has('date_from')) {
                $params['date_from'] = $request->date_from;
            }
            
            if ($request->has('date_to')) {
                $params['date_to'] = $request->date_to;
            }
            
            $response = Http::timeout(10)->get(config('jobaway.api_url') . '/api/v1/purchases', $params);
            
            if ($response->successful()) {
                return collect($response->json('data.data', []));
            }
            
            return collect([]);
            
        } catch (\Exception $e) {
            Log::warning('Failed to fetch JobAway purchases', [
                'error' => $e->getMessage()
            ]);
            return collect([]);
        }
    }

    /**
     * Merge local and API purchases
     */
    private function mergePurchases($localPurchases, $apiPurchases, Request $request)
    {
        try {
            // Convert to array format to avoid getKey() error
            $localArray = $localPurchases->map(function($purchase) {
                $paymentData = is_array($purchase->payment_data) ? $purchase->payment_data : [];
                
                return [
                    'id' => $purchase->id,
                    'transaction_id' => $purchase->transaction_id ?? 'N/A',
                    'customer_name' => is_array($purchase->user_details) ? $purchase->user_details['name'] ?? 'Guest' : 'Guest',
                    'customer_email' => is_array($purchase->user_details) ? $purchase->user_details['email'] ?? 'N/A' : 'N/A',
                    'product_name' => $purchase->product ? $purchase->product->name : 'N/A',
                    'amount' => $purchase->amount,
                    'currency' => $purchase->currency ?? 'INR',
                    'status' => $purchase->status,
                    'payment_gateway' => $purchase->payment_gateway,
                    'payment_method' => $purchase->payment_method ?? $paymentData['payment_method'] ?? null,
                    'payment_status' => $paymentData['payment_status'] ?? null,
                    'created_at' => $purchase->created_at,
                    'source' => 'local'
                ];
            })->toArray();
            
            // Convert API purchases to standard format
            $apiArray = $apiPurchases->map(function($purchase) {
                return [
                    'id' => $purchase['id'] ?? null,
                    'transaction_id' => $purchase['transaction_id'] ?? 'N/A',
                    'customer_name' => $purchase['customer_name'] ?? $purchase['name'] ?? 'Guest',
                    'customer_email' => $purchase['customer_email'] ?? $purchase['email'] ?? 'N/A',
                    'product_name' => $purchase['product_name'] ?? 'N/A',
                    'amount' => $purchase['amount'] ?? 0,
                    'currency' => $purchase['currency'] ?? 'INR',
                    'status' => $purchase['status'] ?? 'pending',
                    'payment_gateway' => $purchase['payment_gateway'] ?? 'unknown',
                    'created_at' => $purchase['created_at'] ?? now(),
                    'source' => 'api'
                ];
            })->toArray();
            
            // Combine both arrays
            $allPurchases = array_merge($localArray, $apiArray);
            
            // Remove duplicates based on transaction_id
            $uniquePurchases = collect($allPurchases)->uniqueStrict('transaction_id');
            
            // Sort by created_at descending
            $sorted = $uniquePurchases->sortByDesc(function($item) {
                return strtotime($item['created_at']);
            })->values();
            
            // Manual pagination
            $perPage = 15;
            $currentPage = $request->get('page', 1);
            $total = $sorted->count();
            
            $items = $sorted->slice(($currentPage - 1) * $perPage, $perPage)->values();
            
            return new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $currentPage,
                [
                    'path' => $request->url(),
                    'pageName' => 'page',
                ]
            );
            
        } catch (\Exception $e) {
            Log::error('Error merging purchases', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Fallback: return local purchases only
            return $localPurchases->paginate(15);
        }
    }

    /**
     * Apply filters to query
     */
    private function applyFilters($query, Request $request)
    {
        // Search filter - require minimum 3 characters and limit search fields
        if ($request->has('search') && $request->search && strlen(trim($request->search)) >= 3) {
            $search = trim($request->search);
            
            // Optimize search by targeting specific indexed fields
            $query->where(function($q) use ($search) {
                // Search by transaction_id (most common search)
                $q->where('transaction_id', 'LIKE', "%{$search}%")
                  
                  // Search by user details in JSON field (for guest purchases)
                  ->orWhereJsonContains('user_details->name', $search)
                  ->orWhereJsonContains('user_details->email', $search)
                  
                  // Search by amount (for exact matches)
                  ->orWhere('amount', 'LIKE', "%{$search}%");
                  
                // Only include user table search if we have relationships loaded
                if ($q->getQuery()->joins || in_array('user', $q->getEagerLoads() ?? [])) {
                    $q->orWhereHas('user', function($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%")
                                 ->orWhere('email', 'LIKE', "%{$search}%");
                    });
                }
            });
        }
        
        // Status filter - use indexed field
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Payment gateway filter - use indexed field
        if ($request->has('payment_gateway') && $request->payment_gateway) {
            $query->where('payment_gateway', $request->payment_gateway);
        }
        
        // Date range filters - use indexed created_at field
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
    }

    /**
     * Calculate comprehensive statistics
     */
    private function calculateStatistics()
    {
        try {
            // Get local statistics
            $localStats = $this->calculateLocalStatistics();
            
            // Get JobAway statistics
            $response = Http::timeout(10)->get(config('jobaway.api_url') . '/api/v1/purchases/statistics/overview');
            
            if ($response->successful()) {
                $apiStats = $response->json('data');
                
                // Merge statistics (avoiding double counting)
                return [
                    'total_purchases' => $localStats['total_purchases'] + $apiStats['total_purchases'],
                    'successful_purchases' => $localStats['successful_purchases'] + $apiStats['successful_purchases'],
                    'failed_purchases' => $localStats['failed_purchases'] + $apiStats['failed_purchases'],
                    'pending_purchases' => $localStats['pending_purchases'] + $apiStats['pending_purchases'],
                    'total_revenue' => $localStats['total_revenue'] + $apiStats['total_revenue'],
                    'today_purchases' => $localStats['today_purchases'] + $apiStats['today_purchases'],
                    'this_month_purchases' => $localStats['this_month_purchases'] + $apiStats['this_month_purchases'],
                ];
            }
            
            return $localStats;
            
        } catch (\Exception $e) {
            Log::warning('Failed to get comprehensive statistics', ['error' => $e->getMessage()]);
            return $this->calculateLocalStatistics();
        }
    }

    /**
     * Calculate local statistics only
     */
    private function calculateLocalStatistics()
    {
        return [
            'total_purchases' => Purchase::count(),
            'successful_purchases' => Purchase::where('status', 'completed')->count(),
            'failed_purchases' => Purchase::where('status', 'failed')->count(),
            'pending_purchases' => Purchase::where('status', 'pending')->count(),
            'total_revenue' => Purchase::where('status', 'completed')->sum('amount'),
            'today_purchases' => Purchase::whereDate('created_at', today())->count(),
            'this_month_purchases' => Purchase::whereMonth('created_at', now()->month)
                                           ->whereYear('created_at', now()->year)
                                           ->count(),
        ];
    }

    /**
     * Format Purchase model data to array format expected by views
     */
    private function formatPurchaseData($purchase)
    {
        $paymentData = is_array($purchase->payment_data) ? $purchase->payment_data : [];
        
        return [
            'id' => $purchase->id,
            'transaction_id' => $purchase->transaction_id,
            'user_id' => $purchase->user_id,
            'product_id' => $purchase->product_id,
            'pricing_id' => $purchase->pricing_id,
            'amount' => $purchase->amount,
            'status' => $purchase->status,
            'payment_method' => $purchase->payment_method ?? $paymentData['payment_method'] ?? null,
            'payment_status' => $paymentData['payment_status'] ?? null,
            'notes' => $paymentData['admin_notes'] ?? null,
            'created_at' => $purchase->created_at,
            'updated_at' => $purchase->updated_at,
            'user' => $purchase->user ? [
                'id' => $purchase->user->id,
                'name' => $purchase->user->name,
                'email' => $purchase->user->email,
            ] : null,
            'product' => $purchase->product ? [
                'id' => $purchase->product->id,
                'name' => $purchase->product->name,
            ] : null,
            'pricing' => $purchase->pricing ? [
                'id' => $purchase->pricing->id,
                'name' => $purchase->pricing->name,
                'price' => $purchase->pricing->price,
            ] : null,
        ];
    }

}
