<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    /**
     * Show sales dashboard
     */
    public function index()
    {
        $stats = $this->getDashboardStats();
        $recentSales = $this->getRecentSales();
        $topProducts = $this->getTopProducts();
        $gatewayStats = $this->getGatewayStats();
        
        return view('sales.dashboard', compact('stats', 'recentSales', 'topProducts', 'gatewayStats'));
    }

    /**
     * Get dashboard statistics
     */
    private function getDashboardStats()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        return [
            'total_sales' => Purchase::successful()->count(),
            'total_revenue' => Purchase::successful()->sum('amount'),
            'today_sales' => Purchase::successful()->whereDate('created_at', $today)->count(),
            'today_revenue' => Purchase::successful()->whereDate('created_at', $today)->sum('amount'),
            'month_sales' => Purchase::successful()->where('created_at', '>=', $thisMonth)->count(),
            'month_revenue' => Purchase::successful()->where('created_at', '>=', $thisMonth)->sum('amount'),
            'last_month_sales' => Purchase::successful()->whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count(),
            'last_month_revenue' => Purchase::successful()->whereBetween('created_at', [$lastMonth, $lastMonthEnd])->sum('amount'),
            'pending_orders' => Purchase::pending()->count(),
            'failed_orders' => Purchase::failed()->count(),
        ];
    }

    /**
     * Get recent sales
     */
    private function getRecentSales($limit = 10)
    {
        return Purchase::with(['product', 'pricing'])
                      ->latest()
                      ->take($limit)
                      ->get();
    }

    /**
     * Get top selling products
     */
    private function getTopProducts($limit = 5)
    {
        return Product::withCount(['purchases as sales_count' => function ($query) {
                          $query->where('status', 'completed');
                      }])
                      ->with(['pricings'])
                      ->orderBy('sales_count', 'desc')
                      ->take($limit)
                      ->get();
    }

    /**
     * Get payment gateway statistics
     */
    private function getGatewayStats()
    {
        return Purchase::select('payment_gateway', 
                               DB::raw('COUNT(*) as total_transactions'),
                               DB::raw('SUM(amount) as total_amount'),
                               DB::raw('COUNT(CASE WHEN status = "completed" THEN 1 END) as successful_transactions'))
                      ->groupBy('payment_gateway')
                      ->get();
    }

    /**
     * Show detailed sales report with filters
     */
    public function report(Request $request)
    {
        $query = Purchase::with(['product', 'pricing']);

        // Apply filters
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }
        
        if ($request->payment_gateway) {
            $query->where('payment_gateway', $request->payment_gateway);
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $purchases = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get summary stats for filtered results
        $summary = [
            'total_count' => $query->count(),
            'total_amount' => $query->sum('amount'),
            'successful_count' => $query->where('status', 'completed')->count(),
            'successful_amount' => $query->where('status', 'completed')->sum('amount'),
        ];

        $products = Product::all();
        $gateways = Purchase::distinct()->pluck('payment_gateway');

        return view('sales.report', compact('purchases', 'summary', 'products', 'gateways'));
    }

    /**
     * Get sales data for charts (AJAX endpoint)
     */
    public function chartData(Request $request)
    {
        $period = $request->get('period', '7days');
        
        switch ($period) {
            case '24hours':
                $data = $this->getHourlyData();
                break;
            case '7days':
                $data = $this->getDailyData(7);
                break;
            case '30days':
                $data = $this->getDailyData(30);
                break;
            case '12months':
                $data = $this->getMonthlyData();
                break;
            default:
                $data = $this->getDailyData(7);
        }

        return response()->json($data);
    }

    /**
     * Get hourly sales data for last 24 hours
     */
    private function getHourlyData()
    {
        $startTime = Carbon::now()->subDay();
        
        $data = Purchase::select(
                    DB::raw('HOUR(created_at) as hour'),
                    DB::raw('COUNT(*) as sales_count'),
                    DB::raw('SUM(amount) as revenue')
                )
                ->where('created_at', '>=', $startTime)
                ->where('status', 'completed')
                ->groupBy(DB::raw('HOUR(created_at)'))
                ->orderBy('hour')
                ->get();

        return [
            'labels' => $data->pluck('hour')->map(function($hour) {
                return sprintf('%02d:00', $hour);
            }),
            'sales' => $data->pluck('sales_count'),
            'revenue' => $data->pluck('revenue')
        ];
    }

    /**
     * Get daily sales data
     */
    private function getDailyData($days)
    {
        $startDate = Carbon::now()->subDays($days);
        
        $data = Purchase::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as sales_count'),
                    DB::raw('SUM(amount) as revenue')
                )
                ->where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get();

        return [
            'labels' => $data->pluck('date')->map(function($date) {
                return Carbon::parse($date)->format('M j');
            }),
            'sales' => $data->pluck('sales_count'),
            'revenue' => $data->pluck('revenue')
        ];
    }

    /**
     * Get monthly sales data for last 12 months
     */
    private function getMonthlyData()
    {
        $startDate = Carbon::now()->subYear();
        
        $data = Purchase::select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as sales_count'),
                    DB::raw('SUM(amount) as revenue')
                )
                ->where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                ->orderBy('year')
                ->orderBy('month')
                ->get();

        return [
            'labels' => $data->map(function($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
            }),
            'sales' => $data->pluck('sales_count'),
            'revenue' => $data->pluck('revenue')
        ];
    }

    /**
     * Export sales report to CSV
     */
    public function export(Request $request)
    {
        $query = Purchase::with(['product', 'pricing']);

        // Apply same filters as report
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }
        
        if ($request->payment_gateway) {
            $query->where('payment_gateway', $request->payment_gateway);
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $purchases = $query->orderBy('created_at', 'desc')->get();

        $filename = 'sales_report_' . date('Y_m_d') . '.csv';
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($purchases) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Date', 'Transaction ID', 'Product', 'Customer Name', 'Email', 
                'Phone', 'Amount', 'Currency', 'Payment Gateway', 'Payment Method', 'Status'
            ]);

            foreach ($purchases as $purchase) {
                fputcsv($file, [
                    $purchase->created_at->format('Y-m-d H:i:s'),
                    $purchase->transaction_id,
                    $purchase->product->name,
                    $purchase->user_details['name'] ?? '',
                    $purchase->user_details['email'] ?? '',
                    $purchase->user_details['phone'] ?? '',
                    $purchase->amount,
                    $purchase->currency,
                    $purchase->payment_gateway,
                    $purchase->payment_method,
                    $purchase->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}