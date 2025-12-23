@extends('layouts.admin')

@section('title', 'Subscriptions')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Subscription Management</h1>
            <p class="text-gray-600 mt-2">Monitor and manage all subscription activities</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Subscriptions -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Subscriptions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $subscriptions->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Subscriptions -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Subscriptions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeSubscriptions }}</p>
                    </div>
                </div>
            </div>

            <!-- Revenue This Month -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <i class="fas fa-rupee-sign text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900">₹{{ number_format($totalRevenue, 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Subscriptions -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingSubscriptions }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
            <form method="GET" action="{{ route('subscription.index') }}" class="flex flex-col sm:flex-row gap-4 items-end justify-between">
                <div class="flex-1 w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Search subscriptions...">
                    </div>
                </div>
                
                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Status</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Expired" {{ request('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
                
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-none inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    <a href="{{ route('subscription.index') }}" class="flex-1 sm:flex-none inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition-colors">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Subscription Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky-header">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sr No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle  text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Plan Price / Title</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($subscriptions as $index => $subscription)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subscriptions->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">
                                    {{ $subscription['transaction_id'] ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                @if(isset($subscription['user']) && $subscription['user'])
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $subscription['user']['unique_user_id'] ?? 'U' . str_pad($subscription['user']['id'], 6, '0', STR_PAD_LEFT) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Guest</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                {{ Str::limit($subscription['customer_name'] ?? 'N/A', 20) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                {{ Str::limit($subscription['customer_email'] ?? 'N/A', 25) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                {{ Str::limit($subscription['product_name'] ?? ($subscription['product']['name'] ?? 'N/A'), 20) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                @php 
                                    $currency = ($subscription['currency'] ?? 'INR') === 'INR' ? '₹' : '$'; 
                                    $amount = $subscription['amount'] ?? 0;
                                @endphp
                                <span class="font-semibold text-green-600">{{ $currency }}{{ number_format($amount, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                <span class="capitalize text-xs bg-gray-100 px-2 py-1 rounded">
                                    {{ $subscription['payment_gateway'] ?? 'unknown' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                                @php
                                    $status = $subscription['status'] ?? 'pending';
                                    $badge = [
                                        'completed' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        'cancelled' => 'bg-gray-100 text-gray-800',
                                    ][$status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center align-middle">
                                {{ $subscription['created_at']->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle text-sm font-medium">
                                <div class="flex items-center justify-center space-x-1">
                                    <a href="{{ route('subscription.show', $subscription['id']) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors duration-200"
                                       title="View Details">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('subscription.edit', $subscription['id']) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-colors duration-200"
                                       title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <button type="button"
                                            onclick="confirmDelete({{ $subscription['id'] }}, '{{ $subscription['transaction_id'] }}')"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors duration-200"
                                            title="Delete">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-8 text-gray-500">No subscriptions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">{{ $subscriptions->firstItem() }}</span> to <span class="font-medium">{{ $subscriptions->lastItem() }}</span> of <span class="font-medium">{{ $subscriptions->total() }}</span> results
                    </p>
                </div>
                <div>
                    {{ $subscriptions->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Confirm Delete</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-gray-600">Are you sure you want to delete this subscription?</p>
                <p class="text-sm text-gray-500 mt-2">Transaction ID: <span id="transactionId" class="font-mono"></span></p>
                <p class="text-red-600 text-sm mt-2">This action cannot be undone.</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                    Cancel
                </button>
                <button onclick="deleteSubscription()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteSubscriptionId = null;
        
        // Show delete confirmation modal
        function confirmDelete(id, transactionId) {
            deleteSubscriptionId = id;
            document.getElementById('transactionId').textContent = transactionId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        
        // Close delete modal
        function closeDeleteModal() {
            deleteSubscriptionId = null;
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
        
        // Delete subscription
        function deleteSubscription() {
            if (!deleteSubscriptionId) return;
            
            fetch(`/subscription/${deleteSubscriptionId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message and reload page
                    alert('Subscription deleted successfully');
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to delete subscription');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the subscription');
            })
            .finally(() => {
                closeDeleteModal();
            });
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endsection