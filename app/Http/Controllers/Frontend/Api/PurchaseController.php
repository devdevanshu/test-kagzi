<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use App\Services\Payment\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * Get all purchases with filtering and pagination
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Purchase::with(['user', 'product', 'pricing']);

            // Apply filters
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('payment_gateway')) {
                $query->where('payment_gateway', $request->payment_gateway);
            }

            if ($request->has('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->has('product_id')) {
                $query->where('product_id', $request->product_id);
            }

            if ($request->has('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            // Search functionality
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('transaction_id', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('email', 'like', "%{$search}%");
                      })
                      ->orWhereHas('product', function($productQuery) use ($search) {
                          $productQuery->where('name', 'like', "%{$search}%");
                      });
                });
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);

            // Pagination
            $perPage = $request->get('per_page', 15);
            $purchases = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $purchases,
                'statistics' => $this->purchaseService->getPurchaseStats()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve purchases',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific purchase by ID
     */
    public function show($id): JsonResponse
    {
        try {
            $purchase = Purchase::with(['user', 'product', 'pricing'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $purchase
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Purchase not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get purchase by transaction ID
     */
    public function getByTransactionId($transactionId): JsonResponse
    {
        try {
            $purchase = $this->purchaseService->findByTransactionId($transactionId);

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Purchase not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $purchase
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve purchase',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user purchases
     */
    public function getUserPurchases($userId): JsonResponse
    {
        try {
            $user = User::findOrFail($userId);
            $purchases = $this->purchaseService->getUserPurchases($user);

            return response()->json([
                'success' => true,
                'data' => $purchases
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user purchases',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get purchase statistics
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = $this->purchaseService->getPurchaseStats();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve purchase statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get revenue report
     */
    public function revenueReport(Request $request): JsonResponse
    {
        try {
            $query = Purchase::where('status', 'completed');

            // Filter by date range
            if ($request->has('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            // Group by different periods
            $groupBy = $request->get('group_by', 'day'); // day, week, month, year

            $revenue = [];
            
            switch ($groupBy) {
                case 'day':
                    $revenue = $query->selectRaw('DATE(created_at) as period, SUM(amount) as total_revenue, COUNT(*) as total_purchases')
                                    ->groupBy('period')
                                    ->orderBy('period', 'desc')
                                    ->get();
                    break;
                    
                case 'month':
                    $revenue = $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(amount) as total_revenue, COUNT(*) as total_purchases')
                                    ->groupBy('period')
                                    ->orderBy('period', 'desc')
                                    ->get();
                    break;
                    
                case 'year':
                    $revenue = $query->selectRaw('YEAR(created_at) as period, SUM(amount) as total_revenue, COUNT(*) as total_purchases')
                                    ->groupBy('period')
                                    ->orderBy('period', 'desc')
                                    ->get();
                    break;
            }

            return response()->json([
                'success' => true,
                'data' => $revenue,
                'total_revenue' => $query->sum('amount'),
                'total_purchases' => $query->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate revenue report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export purchases to CSV
     */
    public function export(Request $request)
    {
        try {
            $query = Purchase::with(['user', 'product', 'pricing']);

            // Apply same filters as index
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('payment_gateway')) {
                $query->where('payment_gateway', $request->payment_gateway);
            }

            if ($request->has('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $purchases = $query->orderBy('created_at', 'desc')->get();

            $filename = 'purchases_export_' . now()->format('Y_m_d_H_i_s') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ];

            $callback = function() use ($purchases) {
                $file = fopen('php://output', 'w');
                
                // CSV headers
                fputcsv($file, [
                    'ID', 'User Name', 'User Email', 'Product Name', 'Plan Name', 
                    'Transaction ID', 'Payment Gateway', 'Payment Method', 'Amount', 
                    'Currency', 'Status', 'Purchase Date'
                ]);

                foreach ($purchases as $purchase) {
                    fputcsv($file, [
                        $purchase->id,
                        $purchase->user ? $purchase->user->name : ($purchase->user_details['name'] ?? ''),
                        $purchase->user ? $purchase->user->email : ($purchase->user_details['email'] ?? ''),
                        $purchase->product->name ?? '',
                        $purchase->pricing->title ?? '',
                        $purchase->transaction_id,
                        $purchase->payment_gateway,
                        $purchase->payment_method,
                        $purchase->amount,
                        $purchase->currency,
                        $purchase->status,
                        $purchase->created_at->format('Y-m-d H:i:s')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to export purchases',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}



