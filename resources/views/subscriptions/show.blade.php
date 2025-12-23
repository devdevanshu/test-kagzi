@extends('layouts.admin')

@section('title', 'Subscription Details - Admin Panel')
@section('page-title', 'Subscription Details')
@section('page-description', 'View subscription information')

@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl p-10 mb-8">
        <div class="mb-8 text-center">
            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Subscription Details</h3>
            <p class="text-gray-500">View complete information about this subscription</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Status Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                <p class="text-sm text-gray-600 font-medium mb-1">Status</p>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                        {{ $subscription['status'] === 'active' ? 'bg-green-100 text-green-800' : 
                           ($subscription['status'] === 'cancelled' ? 'bg-red-100 text-red-800' : 
                            'bg-gray-100 text-gray-800') }}">
                        <i class="fas fa-circle text-xs mr-2"></i>{{ ucfirst($subscription['status'] ?? 'Unknown') }}
                    </span>
                </div>
            </div>

            <!-- Amount Card -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                <p class="text-sm text-gray-600 font-medium mb-1">Amount</p>
                <p class="text-2xl font-bold text-green-700">₹{{ number_format($subscription['amount'] ?? 0, 2) }}</p>
            </div>

            <!-- Source Card -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                <p class="text-sm text-gray-600 font-medium mb-1">Data Source</p>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                    {{ $subscription['source'] === 'local' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                    <i class="fas fa-database text-xs mr-2"></i>{{ ucfirst($subscription['source'] ?? 'Unknown') }}
                </span>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="mb-8 border-b border-gray-200 pb-8">
            <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>Basic Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Transaction ID</label>
                    <p class="text-gray-900 font-mono text-sm">{{ $subscription['transaction_id'] ?? 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Created At</label>
                    <p class="text-gray-900">{{ $subscription['created_at'] ? \Carbon\Carbon::parse($subscription['created_at'])->format('d M Y, h:i A') : 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">User ID</label>
                    <p class="text-gray-900">{{ $subscription['user_id'] ?? 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Updated At</label>
                    <p class="text-gray-900">{{ $subscription['updated_at'] ? \Carbon\Carbon::parse($subscription['updated_at'])->format('d M Y, h:i A') : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- User Information -->
        @if(isset($subscription['user']) && $subscription['user'])
        <div class="mb-8 border-b border-gray-200 pb-8">
            <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-user text-blue-500 mr-2"></i>User Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">User Name</label>
                    <p class="text-gray-900 font-semibold">{{ $subscription['user']['name'] ?? 'N/A' }}</p>
                </div>

                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">User Email</label>
                    <p class="text-gray-900 font-mono text-sm">{{ $subscription['user']['email'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Product Information -->
        <div class="mb-8 border-b border-gray-200 pb-8">
            <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-box text-green-500 mr-2"></i>Product Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Product ID</label>
                    <p class="text-gray-900">{{ $subscription['product_id'] ?? 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Pricing ID</label>
                    <p class="text-gray-900">{{ $subscription['pricing_id'] ?? 'N/A' }}</p>
                </div>

                @if(isset($subscription['product']) && $subscription['product'])
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Product Name</label>
                    <p class="text-gray-900 font-semibold">{{ $subscription['product']['name'] ?? 'N/A' }}</p>
                </div>
                @endif

                @if(isset($subscription['pricing']) && $subscription['pricing'])
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Pricing Name</label>
                    <p class="text-gray-900 font-semibold">{{ $subscription['pricing']['name'] ?? 'N/A' }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Payment Information -->
        @if(isset($subscription['payment_method']) || isset($subscription['payment_status']))
        <div class="mb-8 border-b border-gray-200 pb-8">
            <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-credit-card text-purple-500 mr-2"></i>Payment Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(isset($subscription['payment_method']))
                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Payment Method</label>
                    <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $subscription['payment_method'])) }}</p>
                </div>
                @endif
                
                @if(isset($subscription['payment_status']))
                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Payment Status</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                        {{ $subscription['payment_status'] === 'completed' ? 'bg-green-100 text-green-800' : 
                           ($subscription['payment_status'] === 'failed' ? 'bg-red-100 text-red-800' : 
                            'bg-yellow-100 text-yellow-800') }}">
                        <i class="fas fa-circle text-xs mr-1"></i>{{ ucfirst($subscription['payment_status']) }}
                    </span>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-6">
            @if($subscription['source'] === 'local')
                <a href="{{ route('subscription.edit', $subscription['id']) }}" 
                   class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-semibold transition-colors duration-200 flex items-center">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            @endif
            <a href="{{ route('subscription.index') }}" 
               class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm font-semibold transition-colors duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>
</div>

@endsection