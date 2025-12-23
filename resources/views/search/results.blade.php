@extends('layouts.admin')

@section('title', 'Search Results')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
            @if($query)
                @if(strlen($query) < 3)
                    <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Minimum 3 characters required:</strong> Please enter at least 3 characters to search. You've entered <strong>{{ strlen($query) }}</strong> character(s).
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-600 mt-2">Results for: "<strong>{{ $query }}</strong>"</p>
                @endif
            @else
                <p class="text-gray-600 mt-2">Enter a search term (minimum 3 characters) to find users, contacts, subscriptions, and purchases</p>
            @endif
        </div>

        @if($query && strlen($query) >= 3)
            <!-- Search Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Users Found</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <i class="fas fa-envelope text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Messages Found</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $contacts->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <i class="fas fa-subscription text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Subscriptions Found</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $subscriptions->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100">
                            <i class="fas fa-shopping-cart text-orange-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Purchases Found</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $purchases->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Sections -->
            @if($users->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-users text-blue-600 mr-2"></i>
                    Users ({{ $users->count() }})
                </h2>
                <div class="space-y-3">
                    @foreach($users as $user)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            @if($user->is_admin)
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs mr-2">Admin</span>
                            @endif
                            <span>{{ $user->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($contacts->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-envelope text-green-600 mr-2"></i>
                    Messages ({{ $contacts->count() }})
                </h2>
                <div class="space-y-3">
                    @foreach($contacts as $contact)
                    <div class="flex items-start justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-500">{{ $contact->email }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($contact->message, 100) }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $contact->created_at->format('M j, Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($subscriptions->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-subscription text-purple-600 mr-2"></i>
                    Subscriptions ({{ $subscriptions->count() }})
                </h2>
                <div class="space-y-3">
                    @foreach($subscriptions as $subscription)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ $subscription->name }}</p>
                                <p class="text-sm text-gray-500">{{ $subscription->email }}</p>
                                @if($subscription->transaction_id)
                                <p class="text-xs text-gray-400">TXN: {{ $subscription->transaction_id }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full 
                                @if($subscription->status === 'Active') bg-green-100 text-green-800
                                @elseif($subscription->status === 'Pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $subscription->status }}
                            </span>
                            <p class="text-sm text-gray-500 mt-1">{{ $subscription->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($purchases->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shopping-cart text-orange-600 mr-2"></i>
                    Purchases ({{ $purchases->count() }})
                </h2>
                <div class="space-y-3">
                    @foreach($purchases as $purchase)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-orange-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ optional($purchase->product)->name ?? 'Unknown Product' }}</p>
                                <p class="text-sm text-gray-500">{{ $purchase->email }}</p>
                                @if($purchase->transaction_id)
                                <p class="text-xs text-gray-400">TXN: {{ $purchase->transaction_id }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-900">₹{{ number_format(optional($purchase->pricing)->price ?? 0, 2) }}</p>
                            <p class="text-sm text-gray-500">{{ $purchase->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($users->count() === 0 && $contacts->count() === 0 && $subscriptions->count() === 0 && $purchases->count() === 0)
            <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-200">
                <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 bg-gray-100">
                    <i class="fas fa-search text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900">No Results Found</h3>
                <p class="text-gray-600">No results found for "{{ $query }}". Try searching with different keywords.</p>
            </div>
            @endif
        @elseif($query && strlen($query) < 3)
            <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-200">
                <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 bg-blue-100">
                    <i class="fas fa-info-circle text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900">More Characters Needed</h3>
                <p class="text-gray-600">Please enter at least <strong>3 characters</strong> to search. You've entered <strong>{{ strlen($query) }}</strong> character(s).</p>
                <p class="text-sm text-gray-500 mt-4">You can search by:</p>
                <ul class="text-sm text-gray-600 mt-2 inline-block">
                    <li>• User name or ID</li>
                    <li>• Transaction ID</li>
                    <li>• Product name</li>
                    <li>• Email address</li>
                </ul>
            </div>
        @endif
    </div>
@endsection