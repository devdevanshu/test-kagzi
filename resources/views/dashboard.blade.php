@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your admin panel statistics')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Products</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Product::count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    All products in inventory
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Products</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Currently active
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Users</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Registered users
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Purchases</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Purchase::count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    All time purchases
                </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">₹{{ number_format(\App\Models\Purchase::where('status', 'completed')->sum('amount'), 2) }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Completed purchases
                </p>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-rupee-sign text-emerald-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Completed Purchases</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Purchase::where('status', 'completed')->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Successfully completed
                </p>
            </div>
            <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-double text-teal-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending Purchases</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Purchase::where('status', 'pending')->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Awaiting completion
                </p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Pricing Plans</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Pricing::count() }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Across all products
                </p>
            </div>
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-tags text-indigo-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart Card -->
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Performance</h3>
        <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
            <div class="text-center">
                <i class="fas fa-chart-line text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-600 font-medium">Chart will be displayed here</p>
                <p class="text-sm text-gray-500">Integration with Chart.js or similar library</p>
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
        <div class="space-y-4">
            @php
                $recentProducts = \App\Models\Product::latest()->take(2)->get();
                $recentUsers = \App\Models\User::latest()->take(2)->get();
                $recentPurchases = \App\Models\Purchase::latest()->take(2)->get();
            @endphp
            
            @forelse($recentProducts as $product)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-plus text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Product "{{ Str::limit($product->name, 30) }}" added</p>
                    <p class="text-xs text-gray-500">{{ $product->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                    <i class="fas fa-info text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">No recent products</p>
                    <p class="text-xs text-gray-500">Start by adding your first product</p>
                </div>
            </div>
            @endforelse
            
            @forelse($recentUsers->take(1) as $user)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">User "{{ $user->name }}" registered</p>
                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            @endforelse
            
            @forelse($recentPurchases->take(1) as $purchase)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">New purchase received</p>
                    <p class="text-xs text-gray-500">{{ $purchase->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('add-product') }}" class="btn btn-primary flex items-center justify-center p-4 text-center">
            <i class="fas fa-plus mr-2"></i>
            Add New Product
        </a>
        <a href="{{ route('products.index') }}" class="btn bg-gray-600 text-white hover:bg-gray-700 flex items-center justify-center p-4 text-center">
            <i class="fas fa-list mr-2"></i>
            View Products
        </a>
        <a href="{{ route('payments.index') }}" class="btn bg-green-600 text-white hover:bg-green-700 flex items-center justify-center p-4 text-center">
            <i class="fas fa-credit-card mr-2"></i>
            Payment Settings
        </a>
    </div>
</div>
@endsection
