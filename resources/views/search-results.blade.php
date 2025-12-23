@extends('layouts.admin')

@section('title', 'Search Results')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                <p class="mt-1 text-sm text-gray-600">
                    @if(!empty($query))
                        Showing results for "<span class="font-medium">{{ $query }}</span>"
                    @else
                        Enter a search query to find users, contacts, subscriptions, and purchases
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('search.global') }}" class="flex space-x-4">
                <div class="flex-1">
                    <input type="text" name="q" value="{{ $query }}" 
                           placeholder="Search users, contacts, subscriptions, purchases..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                </div>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </form>
        </div>
    </div>

    @if(!empty($query))
        <!-- Results Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Users</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ count($results['users'] ?? []) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-envelope text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Contacts</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ count($results['contacts'] ?? []) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <i class="fas fa-crown text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Subscriptions</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ count($results['subscriptions'] ?? []) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100">
                        <i class="fas fa-shopping-cart text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Purchases</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ count($results['purchases'] ?? []) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Sections -->
        @if(isset($results['users']) && count($results['users']) > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-users text-blue-600 mr-2"></i>
                        Users ({{ count($results['users']) }})
                    </h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($results['users'] as $user)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                    @if($user->phone)
                                        <p class="text-sm text-gray-500">{{ $user->phone }}</p>
                                    @endif
                                    <p class="text-xs text-gray-400 mt-1">
                                        Registered: {{ $user->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        User
                                    </span>
                                    @if($user->is_admin)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Admin
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($results['contacts']) && count($results['contacts']) > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-envelope text-green-600 mr-2"></i>
                        Contact Messages ({{ count($results['contacts']) }})
                    </h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($results['contacts'] as $contact)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $contact->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                                    <p class="text-sm font-medium text-gray-700 mt-1">{{ $contact->subject }}</p>
                                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($contact->message, 150) }}</p>
                                    <p class="text-xs text-gray-400 mt-2">
                                        {{ $contact->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                                <div class="ml-4 flex flex-col space-y-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $contact->archived ? 'Archived' : 'Active' }}
                                    </span>
                                    <a href="{{ route('contacts.show', $contact->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($results['subscriptions']) && count($results['subscriptions']) > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-crown text-purple-600 mr-2"></i>
                        Subscriptions ({{ count($results['subscriptions']) }})
                    </h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($results['subscriptions'] as $subscription)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ $subscription->user->name ?? 'N/A' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $subscription->user->email ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500">Plan: {{ $subscription->plan_name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Started: {{ $subscription->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Subscription
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $subscription->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($subscription->status ?? 'unknown') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($results['purchases']) && count($results['purchases']) > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-shopping-cart text-orange-600 mr-2"></i>
                        Purchases ({{ count($results['purchases']) }})
                    </h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($results['purchases'] as $purchase)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ $purchase->user->name ?? 'N/A' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $purchase->user->email ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500">Product: {{ $purchase->product->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500">Amount: ${{ number_format($purchase->amount ?? 0, 2) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $purchase->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        Purchase
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $purchase->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($purchase->status ?? 'unknown') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(empty($results) || (count($results['users']) == 0 && count($results['contacts']) == 0 && count($results['subscriptions']) == 0 && count($results['purchases']) == 0))
            <div class="bg-white rounded-lg shadow">
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-search text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No results found</h3>
                    <p class="text-gray-600 mb-6">We couldn't find anything matching "{{ $query }}". Try different keywords or check your spelling.</p>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection