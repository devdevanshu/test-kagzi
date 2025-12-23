@extends('layouts.admin')

@section('title', 'View Product - Admin Panel')
@section('page-title', 'Product Details')
@section('page-description', 'View product information')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="card p-10 bg-white rounded-3xl shadow-lg border border-gray-100">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600">Product details and information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('products.edit', $product) }}"
                   class="btn btn-primary">
                    <i class="fas fa-edit mr-2"></i>Edit Product
                </a>
                <a href="{{ route('products.index') }}"
                   class="btn bg-gray-600 text-white hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Products
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Product Images -->
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-to-r from-blue-50 to-purple-50 border-b border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-800 mt-4 mb-4 ml-4 pt-2">
                        &nbsp;<i class="fas fa-images mr-2 me-1 text-blue-600"></i>Product Images
                    </h4>
                </div>
                <div class="card-body p-6">
                    @if($product->images && count($product->images) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($product->images as $image)
                                <div class="relative group">
                                    @php
                                        $imgFile = str_replace('products/', '', ltrim($image, '/'));
                                        $imgPath = 'storage/products/' . $imgFile;
                                    @endphp
                                    <img src="{{ asset($imgPath) }}"
                                         alt="{{ $product->name }}"
                                         onerror="this.onerror=null;this.src='{{ asset('images/default-product.png') }}';"
                                         class="w-full h-56 object-cover rounded-lg shadow-md border border-gray-200">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity rounded-lg"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-image text-gray-400 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg">No images uploaded</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Information -->
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-800 mt-4 ml-4 mb-4 pt-2">
                        &nbsp;<i class="fas fa-info-circle mr-2 text-green-600"></i>Product Information
                    </h4>
                </div>
                <div class="card-body p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tag mr-1 text-blue-500"></i>Name
                            </label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $product->name }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-link mr-1 text-green-500"></i>Project URL
                            </label>
                            @if($product->project_url)
                                <a href="{{ $product->project_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium break-all">
                                    {{ $product->project_url }}
                                    <i class="fas fa-external-link-alt ml-1 text-sm"></i>
                                </a>
                            @else
                                <p class="text-gray-500">No project URL provided</p>
                            @endif
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Price
                            </label>
                            @php
                                $domesticPlans = $product->pricings->where('region', 'D');
                                $internationalPlans = $product->pricings->where('region', 'I');
                            @endphp
                            <div class="space-y-2">
                                <div>
                                    <span class="font-bold text-blue-700">Domestic Plans</span>
                                    @if($domesticPlans->count() > 0)
                                        <div class="space-y-1 mt-1">
                                            @foreach($domesticPlans as $plan)
                                                <div class="text-gray-900 font-semibold text-lg">
                                                    <span class="font-semibold">{{ $plan->title }}:</span>
                                                    <span class="text-blue-700 font-bold">₹{{ number_format($plan->price, 2) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">No domestic plans available</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-bold text-green-700">International Plans</span>
                                    @if($internationalPlans->count() > 0)
                                        <div class="space-y-1 mt-1">
                                            @foreach($internationalPlans as $plan)
                                                <div class="text-gray-900 font-semibold text-lg">
                                                    <span class="font-semibold">{{ $plan->title }}:</span>
                                                    <span class="text-green-700 font-bold">${{ number_format($plan->price, 2) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">No international plans available</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Status
                            </label>
                            <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full
                                {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-align-left mr-1 text-gray-600"></i>Description
                        </label>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <p class="text-gray-900 leading-relaxed">{{ $product->description ?: 'No description provided' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-plus mr-1 text-blue-500"></i>Created At
                            </label>
                            <p class="text-gray-600 font-medium">{{ $product->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-edit mr-1 text-green-500"></i>Last Updated
                            </label>
                            <p class="text-gray-600 font-medium">{{ $product->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Actions -->
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                <h4 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-cogs mr-2 text-gray-600"></i>Quick Actions
                </h4>
            </div>
            <div class="card-body p-6">
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('add-product') }}"
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                        <i class="fas fa-edit mr-2"></i>Edit Product
                    </a>

                    <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-{{ $product->is_active ? 'yellow' : 'green' }}-600 text-white rounded-lg hover:bg-{{ $product->is_active ? 'yellow' : 'green' }}-700 transition-colors shadow-md">
                            <i class="fas fa-{{ $product->is_active ? 'pause' : 'play' }} mr-2"></i>
                            {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')"
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-md">
                            <i class="fas fa-trash mr-2"></i>Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
