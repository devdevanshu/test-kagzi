@extends('layouts.admin')

@section('title', 'Payment Gateways - Admin Panel')
@section('page-title', 'Payment Gateways')
@section('page-description', 'Manage payment gateway configurations')

@section('content')

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-3"></i>
            <span>{{ session('warning') }}</span>
        </div>
    </div>
@endif

<div class="mb-6">
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-info-circle mr-3"></i>
            <div>
                <h4 class="font-semibold">Supported Payment Gateways</h4>
                <p class="text-sm mt-1">Only Cashfree and PayPal are supported. All other payment gateways have been disabled for security and maintenance purposes.</p>
            </div>
        </div>
    </div>
</div>

<!-- Payment Gateways -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Cashfree Card -->
    <div class="card p-6">
        <form method="POST" action="{{ route('admin.cashfree.update', $cashfree->id ?? 1) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="card_title" value="Cashfree">
            
            <div class="text-center mb-6">
                <div class="flex justify-center items-center mb-3">
                    <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-credit-card text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $cashfree->is_active ?? false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $cashfree->is_active ?? false ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">Cashfree</h2>
                <p class="text-sm text-gray-600 mt-1">Primary gateway for Indian payments</p>
            </div>
            
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="active" 
                                   id="cashfree_active" 
                                   class="h-4 w-4 text-orange-600 border-gray-300 focus:ring-orange-500"
                                   {{ ($cashfree->information['status'] ?? 'inactive') === 'active' ? 'checked' : '' }}>
                            <label for="cashfree_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="inactive" 
                                   id="cashfree_inactive" 
                                   class="h-4 w-4 text-orange-600 border-gray-300 focus:ring-orange-500"
                                   {{ ($cashfree->information['status'] ?? 'inactive') === 'inactive' ? 'checked' : '' }}>
                            <label for="cashfree_inactive" class="ml-2 text-sm text-gray-700">Inactive</label>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Environment</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="environment" 
                                   value="sandbox" 
                                   id="cashfree_sandbox" 
                                   class="h-4 w-4 text-orange-600 border-gray-300 focus:ring-orange-500"
                                   {{ ($cashfree->information['environment'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' }}>
                            <label for="cashfree_sandbox" class="ml-2 text-sm text-gray-700">Test Mode</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="environment" 
                                   value="production" 
                                   id="cashfree_production" 
                                   class="h-4 w-4 text-orange-600 border-gray-300 focus:ring-orange-500"
                                   {{ ($cashfree->information['environment'] ?? 'sandbox') === 'production' ? 'checked' : '' }}>
                            <label for="cashfree_production" class="ml-2 text-sm text-gray-700">Live Mode</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">App ID</label>
                    <input type="text" 
                           name="app_id" 
                           value="{{ $cashfree->information['app_id'] ?? '' }}" 
                           class="input w-full" 
                           placeholder="Enter Cashfree App ID"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Secret Key</label>
                    <input type="password" 
                           name="secret_key" 
                           value="{{ $cashfree->information['secret_key'] ?? '' }}" 
                           class="input w-full" 
                           placeholder="Enter Cashfree Secret Key"
                           required>
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" class="btn btn-primary w-full bg-orange-600 hover:bg-orange-700">
                    <i class="fas fa-save mr-2"></i>Save Cashfree Settings
                </button>
            </div>
        </form>
    </div>

    <!-- PayPal Card -->
    <div class="card p-6">
        <form method="POST" action="{{ route('admin.paypal.update', $paypal->id ?? 1) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="card_title" value="Paypal">
            
            <div class="text-center mb-6">
                <div class="flex justify-center items-center mb-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fab fa-paypal text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $paypal->is_active ?? false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $paypal->is_active ?? false ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">PayPal</h2>
                <p class="text-sm text-gray-600 mt-1">International payment gateway</p>
            </div>
            
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="active" 
                                   id="paypal_active" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                   {{ ($paypal->information['status'] ?? 'inactive') === 'active' ? 'checked' : '' }}>
                            <label for="paypal_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="inactive" 
                                   id="paypal_inactive" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                   {{ ($paypal->information['status'] ?? 'inactive') === 'inactive' ? 'checked' : '' }}>
                            <label for="paypal_inactive" class="ml-2 text-sm text-gray-700">Inactive</label>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Environment</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="environment" 
                                   value="sandbox" 
                                   id="paypal_sandbox" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                   {{ ($paypal->information['environment'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' }}>
                            <label for="paypal_sandbox" class="ml-2 text-sm text-gray-700">Sandbox</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="environment" 
                                   value="production" 
                                   id="paypal_production" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                   {{ ($paypal->information['environment'] ?? 'sandbox') === 'production' ? 'checked' : '' }}>
                            <label for="paypal_production" class="ml-2 text-sm text-gray-700">Production</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client ID</label>
                    <input type="text" 
                           name="client_id" 
                           value="{{ $paypal->information['client_id'] ?? '' }}" 
                           class="input w-full" 
                           placeholder="Enter PayPal Client ID"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client Secret</label>
                    <input type="password" 
                           name="client_secret" 
                           value="{{ $paypal->information['client_secret'] ?? '' }}" 
                           class="input w-full" 
                           placeholder="Enter PayPal Client Secret"
                           required>
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" class="btn btn-primary w-full bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Save PayPal Settings
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Payment Gateway Statistics -->
<div class="mt-8">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Gateway Statistics</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-gray-900" id="total-transactions">0</div>
                <div class="text-sm text-gray-600">Total Transactions</div>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-green-600" id="successful-transactions">0</div>
                <div class="text-sm text-gray-600">Successful</div>
            </div>
            <div class="bg-orange-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-orange-600" id="cashfree-transactions">0</div>
                <div class="text-sm text-gray-600">Cashfree</div>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-blue-600" id="paypal-transactions">0</div>
                <div class="text-sm text-gray-600">PayPal</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Load gateway statistics
document.addEventListener('DOMContentLoaded', function() {
    fetch('{{ route('payment.gateways.statistics') }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateStatistics(data.data);
            }
        })
        .catch(error => console.error('Error loading statistics:', error));
});

function updateStatistics(stats) {
    let totalTransactions = 0;
    let successfulTransactions = 0;
    let cashfreeTransactions = 0;
    let paypalTransactions = 0;
    
    for (const [gateway, data] of Object.entries(stats)) {
        totalTransactions += data.total_transactions;
        successfulTransactions += data.successful_transactions;
        
        if (gateway === 'cashfree') {
            cashfreeTransactions = data.total_transactions;
        } else if (gateway === 'paypal') {
            paypalTransactions = data.total_transactions;
        }
    }
    
    document.getElementById('total-transactions').textContent = totalTransactions;
    document.getElementById('successful-transactions').textContent = successfulTransactions;
    document.getElementById('cashfree-transactions').textContent = cashfreeTransactions;
    document.getElementById('paypal-transactions').textContent = paypalTransactions;
}
</script>
@endsection
