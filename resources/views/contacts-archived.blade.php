@extends('layouts.admin')

@section('title', 'Archived Messages')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Archived Messages</h1>
                <p class="mt-1 text-sm text-gray-600">Manage archived contact messages</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('contacts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Active Messages
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100">
                    <i class="fas fa-archive text-red-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Archived Messages</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $contacts->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <i class="fas fa-envelope text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Messages</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ App\Models\Contact::where('archived', false)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <i class="fas fa-envelope-open text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Messages</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ App\Models\Contact::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filter Messages</h3>
        </div>
        <div class="p-4">
            <form method="GET" action="{{ route('contacts.archived') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                           placeholder="Name, email, subject..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                    <select id="sort_by" name="sort_by" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Received</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="subject" {{ request('sort_by') == 'subject' ? 'selected' : '' }}>Subject</option>
                    </select>
                </div>
                
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                    <select id="sort_order" name="sort_order" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Newest First</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-filter mr-2"></i>Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-4 py-5 sm:p-6">
            @if($contacts->count() > 0)
                <div class="space-y-4">
                    @foreach($contacts as $contact)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $contact->name }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-archive mr-1"></i>
                                            Archived
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-1">
                                        <i class="fas fa-envelope mr-2"></i>{{ $contact->email }}
                                    </p>
                                    
                                    <p class="text-sm text-gray-600 mb-2">
                                        <i class="fas fa-tag mr-2"></i>{{ $contact->subject }}
                                    </p>
                                    
                                    <p class="text-gray-700 mb-3">{{ Str::limit($contact->message, 150) }}</p>
                                    
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $contact->created_at->format('M d, Y') }}
                                        </span>
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $contact->created_at->format('h:i A') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mt-4 sm:mt-0 sm:ml-4">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('contacts.show', $contact->id) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-eye mr-2"></i>View
                                        </a>
                                        
                                        <form action="{{ route('contacts.unarchive', $contact->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="w-full inline-flex items-center px-3 py-2 border border-green-300 shadow-sm text-sm leading-4 font-medium rounded-lg text-green-700 bg-green-50 hover:bg-green-100 transition-colors"
                                                    onclick="return confirm('Are you sure you want to unarchive this message?')">
                                                <i class="fas fa-undo mr-2"></i>Unarchive
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($contacts->hasPages())
                    <div class="mt-6">
                        {{ $contacts->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-archive text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No archived messages</h3>
                    <p class="text-gray-600 mb-6">There are no archived messages to display.</p>
                    <a href="{{ route('contacts.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Go to Active Messages
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection