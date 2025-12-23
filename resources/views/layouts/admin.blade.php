<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #977EFF;
            --secondary-color: #7A5FD6;
            --accent-color: #977EFF;
            --theme-color: #977EFF;
            --theme-color-light: #B9A3FF;
            --theme-color-lighter: #E8DFFE;
            --theme-color-dark: #6B4FCC;
            --border-color: #E8DFFE;
            --bg-primary: #ffffff;
            --bg-secondary: #F8F6FF;
            --text-primary: #111111;
            --text-secondary: #666666;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
        }
        
        .sidebar-link {
            transition: all 0.2s ease;
        }
        
        .sidebar-link:hover {
            background-color: var(--bg-secondary);
            color: var(--accent-color);
        }
        
        .sidebar-link.active {
            background-color: var(--accent-color);
            color: white;
        }
        
        .card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--theme-color-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(151, 126, 255, 0.4);
        }
        
        .input {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            transition: border-color 0.2s ease;
        }
        
        .input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(151, 126, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen" style="background-color: var(--bg-secondary);">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
        
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-4 lg:px-6 py-4">
                <div class="flex items-center justify-between gap-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <!-- Page Title -->
                    <div class="flex-1 lg:ml-0 ml-4">
                        <h1 class="text-xl lg:text-2xl font-semibold text-gray-900 mb-1">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-600 hidden sm:block">@yield('page-description', 'Welcome to your admin panel')</p>
                    </div>

                    <!-- Header Search -->
                    <div class="hidden md:block relative">
                        <form action="{{ route('search.global') }}" method="GET" target="_blank">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="q" placeholder="Search users, transactions..." 
                                       class="block w-80 pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-1 focus:border-purple-500" style="--tw-ring-color: var(--accent-color);">
                            </div>
                        </form>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('contacts.index') }}" class="relative p-2 text-gray-600 hover:text-purple-600 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            @php
                                $unreadCount = \App\Models\Contact::where('archived', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="absolute -top-1 -right-1 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center" style="background-color: var(--accent-color);">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('logout') }}" class="flex items-center space-x-2 text-gray-600 hover:text-purple-600 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden lg:block text-sm">Logout</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto" style="background-color: var(--bg-secondary);">
                <div class="max-w-8xl mx-auto px-4 lg:px-6 py-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
            
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
