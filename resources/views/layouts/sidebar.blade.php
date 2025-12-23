
<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col">
    <!-- Logo Area -->
    <div class="px-6 py-3 border-b border-gray-200">
        <div class="flex items-center justify-center mb-4">
            <img src="{{ asset('Kagziinfotech.png') }}" alt="Kagzi Admin" class="h-12 object-contain">
        </div>
        
        <!-- Sidebar Search Button -->
        {{-- <button onclick="openSearchModal()" class="w-full flex items-center px-4 py-3 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium transition-colors">
            <i class="fas fa-search mr-3"></i>
            <span>Global Search</span>
        </button> --}}
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('dashboard') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-tachometer-alt mr-3 text-base"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('add-product') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('add-product') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('add-product') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-plus mr-3 text-base"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('products.*') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('products.*') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-box mr-3 text-base"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('payments.index') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('payments.index') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('payments.index') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-credit-card mr-3 text-base"></i>
                    <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subscription.index') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('subscription.index') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('subscription.index') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-users mr-3 text-base"></i>
                    <span>Subscriptions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('contacts.index') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('contacts.index') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('contacts.index') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-envelope mr-3 text-base"></i>
                    <span>Messages</span>
                    @php
                        $unreadCount = \App\Models\Contact::where('archived', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="ml-auto text-white text-xs rounded-full px-2 py-1" style="background-color: var(--accent-color);">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('contacts.archived') }}"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('contacts.archived') ? 'active' : 'text-gray-700 hover:text-purple-600' }}" style="{{ !request()->routeIs('contacts.archived') ? 'transition: all 0.2s ease;' : '' }}" onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--bg-secondary)'" onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor=''">
                    <i class="fas fa-archive mr-3 text-base"></i>
                    <span>Archive</span>
                    @php
                        $archivedCount = \App\Models\Contact::where('archived', true)->count();
                    @endphp
                    {{-- @if($archivedCount > 0)
                        <span class="ml-auto bg-gray-500 text-white text-xs rounded-full px-2 py-1">{{ $archivedCount }}</span>
                    @endif --}}
                </a>
            </li>
            
            <!-- Divider -->
            <li class="my-4 border-t border-gray-200"></li>
            
            <!-- View Website Link -->
            <li>
                <a href="{{ route('home') }}" 
                   target="_blank"
                   class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:text-purple-600" 
                   style="transition: all 0.2s ease;" 
                   onmouseover="this.style.backgroundColor='var(--bg-secondary)'" 
                   onmouseout="this.style.backgroundColor=''">
                    <i class="fas fa-globe mr-3 text-base"></i>
                    <span>View Website</span>
                    <i class="fas fa-external-link-alt ml-auto text-xs opacity-60"></i>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- User Profile -->
    <div class="px-4 py-6 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-600 text-sm"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Admin User</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
            <a href="{{ route('logout') }}" 
               title="Logout" 
               class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-sign-out-alt text-sm"></i>
            </a>
        </div>
    </div>
</aside>

<script>
function openSearchModal() {
    document.getElementById('searchModal').classList.remove('hidden');
    document.getElementById('searchInput').focus();
}

function closeSearchModal() {
    document.getElementById('searchModal').classList.add('hidden');
    document.getElementById('searchInput').value = '';
    document.getElementById('searchResultsContainer').innerHTML = '';
}

function performSearch() {
    const query = document.getElementById('searchInput').value.trim();
    
    if (query.length < 3) {
        document.getElementById('searchResultsContainer').innerHTML = '<div class="p-4 text-center text-yellow-600"><i class="fas fa-info-circle mr-2"></i>Enter at least 3 characters to search</div>';
        return;
    }

    // Show loading state
    document.getElementById('searchResultsContainer').innerHTML = '<div class="p-4 text-center"><i class="fas fa-spinner fa-spin text-blue-600"></i> Searching...</div>';

    fetch(`/api/search/live?q=${encodeURIComponent(query)}`)
        .then(response => {
            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Invalid response format - expected JSON');
            }
            return response.json();
        })
        .then(results => {
            if (!Array.isArray(results) || results.length === 0) {
                document.getElementById('searchResultsContainer').innerHTML = '<div class="p-4 text-center text-gray-500">No results found</div>';
            } else {
                displaySearchResults(results);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            document.getElementById('searchResultsContainer').innerHTML = '<div class="p-4 text-center text-red-600"><i class="fas fa-exclamation-circle mr-2"></i>Search failed. Please try again.</div>';
        });
}

function displaySearchResults(results) {
    const resultsHTML = results.map(result => `
        <a href="${result.url}" class="block p-4 hover:bg-blue-50 border-b border-gray-100 last:border-b-0 transition-colors">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold mr-2 
                    ${result.type === 'user' ? 'bg-blue-100 text-blue-800' : 
                      result.type === 'contact' ? 'bg-green-100 text-green-800' : 
                      result.type === 'subscription' ? 'bg-purple-100 text-purple-800' : 
                      'bg-orange-100 text-orange-800'}">
                    <i class="fas ${result.type === 'user' ? 'fa-user' : 
                                   result.type === 'contact' ? 'fa-envelope' : 
                                   result.type === 'subscription' ? 'fa-crown' : 
                                   'fa-shopping-cart'} mr-1"></i>
                    ${result.type}
                </span>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-900">${result.title}</div>
                    <div class="text-xs text-gray-500 mt-1">${result.subtitle}</div>
                </div>
            </div>
        </a>
    `).join('');
    
    document.getElementById('searchResultsContainer').innerHTML = resultsHTML;
}

// Search on Enter key press
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }

    // Close modal when clicking outside
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeSearchModal();
            }
        });
    }
});
</script>

<!-- Search Modal -->
<div id="searchModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-96 flex flex-col">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <i class="fas fa-search text-blue-600 text-lg"></i>
                <h2 class="text-xl font-bold text-gray-900">Global Search</h2>
            </div>
            <button onclick="closeSearchModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Modal Content -->
        <div class="flex-1 flex flex-col">
            <!-- Search Input -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search users, contacts, subscriptions, purchases..." 
                           class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           autocomplete="off">
                </div>
            </div>
            
            <!-- Results Container -->
            <div id="searchResultsContainer" class="flex-1 overflow-y-auto">
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-search text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm">Enter search terms to find users, contacts, subscriptions, and purchases</p>
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <p class="text-xs text-gray-500">Press Enter to search</p>
            <button onclick="closeSearchModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition-colors">
                Close
            </button>
        </div>
    </div>
</div>
