@extends('layouts.admin')

@section('title', 'Products - Kagzi Admin')
@section('page-title', 'Products')
@section('page-description', 'Manage your product inventory')

@section('content')

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-1">All Products</h2>
        <p class="text-sm text-gray-600">Manage your product inventory and listings</p>
    </div>
    <div class="mt-4 md:mt-0">
        <a href="{{ route('add-product') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Add New Product
        </a>
    </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Products</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $products->total() ?? $products->count() }}</p>
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
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $products->where('is_active', true)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Inactive Products</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Product::where('is_active', false)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-pause-circle text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Purchases</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Purchase::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-shopping-bag text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

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

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
    <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4 items-end justify-between">
        <div class="flex-1 w-full md:w-auto">
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
        </div>
        <div class="w-full md:w-auto">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <option value="">All Products</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="flex-1 md:flex-none inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Search
            </button>
            <a href="{{ route('products.index') }}" class="flex-1 md:flex-none inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">
                <i class="fas fa-times mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Products Table -->
<div class="card overflow-hidden">
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($product->images && count($product->images) > 0)
                                        <img class="h-12 w-12 rounded-lg object-cover"
                                             src="{{ asset('storage/' . $product->images[0]) }}"
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="h-12 w-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                                    @if($product->sku)
                                        <div class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded mt-1 inline-block">
                                            SKU: {{ $product->sku }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $region = null;
                                    if ($product->pricings && $product->pricings->count() > 0) {
                                        $region = $product->pricings->first()->region;
                                    }
                                @endphp
                                @if($region === 'D')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Domestic</span>
                                @elseif($region === 'I')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">International</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">-</span>
                                @endif
                            </td> --}}
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</div>
                            </td> --}}
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $product->stock_quantity > 10 ? 'bg-green-100 text-green-800' :
                                       ($product->stock_quantity > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock_quantity }} items
                                </span>
                            </td> --}}
                        <td class="px-6 py-4 text-center">
                            @if($product->is_active)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-500">
                            {{ $product->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors duration-200"
                                   title="View Product">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('products.edit', $product) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-colors duration-200"
                                   title="Edit Product">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 {{ $product->is_active ? 'bg-yellow-100 hover:bg-yellow-200 text-yellow-600' : 'bg-emerald-100 hover:bg-emerald-200 text-emerald-600' }} rounded-lg transition-colors duration-200"
                                            title="{{ $product->is_active ? 'Deactivate Product' : 'Activate Product' }}">
                                        <i class="fas fa-{{ $product->is_active ? 'pause' : 'play' }} text-sm"></i>
                                    </button>
                                </form>
                                <button type="button"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors duration-200"
                                        title="Delete Product"
                                        onclick="document.getElementById('delete-modal-{{ $product->id }}').classList.remove('hidden')">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                                
                                <!-- Delete Confirmation Modal -->
                                <div id="delete-modal-{{ $product->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                    <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full mx-4">
                                        <div class="text-center">
                                            <div class="w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm Deletion</h3>
                                            <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete <strong>{{ $product->name }}</strong>? This action cannot be undone.</p>
                                            <div class="flex space-x-3">
                                                <button type="button" 
                                                        class="btn bg-gray-600 text-white hover:bg-gray-700 flex-1"
                                                        onclick="document.getElementById('delete-modal-{{ $product->id }}').classList.add('hidden')">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 w-full">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-box-open text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Products Yet</h3>
            <p class="text-gray-600 mb-6">Get started by adding your first product to the inventory.</p>
            <a href="{{ route('add-product') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Add First Product
            </a>
        </div>
    @endif
    </div>
</div>
@endsection
