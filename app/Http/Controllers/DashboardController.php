<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Get dashboard statistics
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_sales' => Purchase::where('status', 'completed')->count(),
            'total_revenue' => Purchase::where('status', 'completed')->sum('amount'),
            'today_sales' => Purchase::where('status', 'completed')->whereDate('created_at', Carbon::today())->count(),
            'today_revenue' => Purchase::where('status', 'completed')->whereDate('created_at', Carbon::today())->sum('amount'),
            'pending_orders' => Purchase::where('status', 'pending')->count(),
        ];

        // Get recent sales
        $recentSales = Purchase::with(['product'])
                              ->latest()
                              ->take(5)
                              ->get();

        // Get top products
        $topProducts = Product::withCount(['purchases as sales_count' => function ($query) {
                                  $query->where('status', 'completed');
                              }])
                              ->orderBy('sales_count', 'desc')
                              ->take(5)
                              ->get();

        return view('dashboard', compact('stats', 'recentSales', 'topProducts'));
    }
}
