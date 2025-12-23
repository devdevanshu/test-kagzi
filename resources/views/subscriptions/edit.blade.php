@extends('layouts.admin')

@section('title', 'Edit Subscription - Admin Panel')
@section('page-title', 'Edit Subscription')
@section('page-description', 'Update subscription information')

@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl p-10 mb-8">
        <div class="mb-8 text-center">
            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Edit Subscription</h3>
            <p class="text-gray-500">Update the subscription details below</p>
        </div>

        @if($subscription['source'] !== 'local')
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>Warning:</strong> This is an API-sourced subscription. Changes may not be synchronized back to the original system.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('subscription.update', $subscription['id']) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="block mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Validation Errors:</strong>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Basic Information -->
            <div class="border-b border-gray-200 pb-6">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>Basic Information
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="transaction_id" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-receipt mr-2 text-blue-500"></i>Transaction ID
                        </label>
                        <input type="text" 
                               name="transaction_id" 
                               id="transaction_id" 
                               value="{{ old('transaction_id', $subscription['transaction_id'] ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               {{ $subscription['source'] !== 'local' ? 'readonly' : '' }}>
                        @error('transaction_id')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-toggle-on mr-2 text-blue-500"></i>Status
                        </label>
                        <select name="status" 
                                id="status" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="active" {{ old('status', $subscription['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $subscription['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="cancelled" {{ old('status', $subscription['status'] ?? '') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="expired" {{ old('status', $subscription['status'] ?? '') === 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="amount" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-rupee-sign mr-2 text-blue-500"></i>Amount (₹)
                        </label>
                        <input type="number" 
                               name="amount" 
                               id="amount" 
                               step="0.01"
                               min="0"
                               value="{{ old('amount', $subscription['amount'] ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-user mr-2 text-blue-500"></i>User ID
                        </label>
                        <input type="number" 
                               name="user_id" 
                               id="user_id" 
                               value="{{ old('user_id', $subscription['user_id'] ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               {{ $subscription['source'] !== 'local' ? 'readonly' : '' }}>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="border-b border-gray-200 pb-6">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-box text-green-500 mr-2"></i>Product Information
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="product_id" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-tag mr-2 text-green-500"></i>Product ID
                        </label>
                        <input type="number" 
                               name="product_id" 
                               id="product_id" 
                               value="{{ old('product_id', $subscription['product_id'] ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               {{ $subscription['source'] !== 'local' ? 'readonly' : '' }}>
                        @error('product_id')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pricing_id" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-money-bill mr-2 text-green-500"></i>Pricing ID
                        </label>
                        <input type="number" 
                               name="pricing_id" 
                               id="pricing_id" 
                               value="{{ old('pricing_id', $subscription['pricing_id'] ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               {{ $subscription['source'] !== 'local' ? 'readonly' : '' }}>
                        @error('pricing_id')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="border-b border-gray-200 pb-6">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-credit-card text-purple-500 mr-2"></i>Payment Information (Optional)
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="payment_method" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-wallet mr-2 text-purple-500"></i>Payment Method
                        </label>
                        <select name="payment_method" 
                                id="payment_method" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">Select Payment Method</option>
                            <option value="credit_card" {{ old('payment_method', $subscription['payment_method'] ?? '') === 'credit_card' ? 'selected' : '' }}>
                                <i class="fas fa-credit-card mr-1"></i>Credit Card
                            </option>
                            <option value="debit_card" {{ old('payment_method', $subscription['payment_method'] ?? '') === 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                            <option value="net_banking" {{ old('payment_method', $subscription['payment_method'] ?? '') === 'net_banking' ? 'selected' : '' }}>Net Banking</option>
                            <option value="upi" {{ old('payment_method', $subscription['payment_method'] ?? '') === 'upi' ? 'selected' : '' }}>UPI</option>
                            <option value="wallet" {{ old('payment_method', $subscription['payment_method'] ?? '') === 'wallet' ? 'selected' : '' }}>Wallet</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="payment_status" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-check-double mr-2 text-purple-500"></i>Payment Status
                        </label>
                        <select name="payment_status" 
                                id="payment_status" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">Select Payment Status</option>
                            <option value="pending" {{ old('payment_status', $subscription['payment_status'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ old('payment_status', $subscription['payment_status'] ?? '') === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ old('payment_status', $subscription['payment_status'] ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ old('payment_status', $subscription['payment_status'] ?? '') === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ old('payment_status', $subscription['payment_status'] ?? '') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                        @error('payment_status')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="pb-6">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-sticky-note text-orange-500 mr-2"></i>Notes (Optional)
                </h4>
                
                <div>
                    <label for="notes" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-comment mr-2 text-orange-500"></i>Admin Notes
                    </label>
                    <textarea name="notes" 
                              id="notes" 
                              rows="5"
                              placeholder="Add any admin notes or comments about this subscription..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('notes', $subscription['notes'] ?? '') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('subscription.show', $subscription['id']) }}" 
                   class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg text-sm font-semibold transition-colors duration-200 flex items-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition-colors duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>Update Subscription
                </button>
            </div>
        </form>
    </div>
</div>

@endsection