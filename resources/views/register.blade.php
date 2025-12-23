<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Registration - Kagzi Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #374151;
            --secondary-color: #6b7280;
            --accent-color: #3b82f6;
            --border-color: #e5e7eb;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            background-color: var(--bg-secondary);
            min-height: 100vh;
        }
        
        .card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .input {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.75rem;
            transition: border-color 0.2s ease;
            font-family: inherit;
        }
        
        .input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        
        .brand-logo {
            color: var(--accent-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="card w-full max-w-md p-8">
        <div class="text-center mb-8">
            <div class="brand-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Create Admin Account</h1>
            <p class="text-sm mt-2" style="color: var(--text-secondary);">Register for administrator access</p>
        </div>

        <form id="registerForm" class="space-y-6" method="POST" action="{{ route('register.post') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="input w-full"
                    placeholder="Enter your full name"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="input w-full"
                    placeholder="Enter your email"
                >
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    required
                    class="input w-full"
                    placeholder="Enter your phone number"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="input w-full"
                    placeholder="Create a password"
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="input w-full"
                    placeholder="Confirm your password"
                >
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <button
                type="submit"
                class="btn btn-primary w-full"
            >
                <i class="fas fa-user-plus mr-2"></i>
                Create Administrator Account
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm" style="color: var(--text-secondary);">
                Already have an administrator account?
                <a href="{{ route('admin.login') }}" class="font-medium hover:underline" style="color: var(--accent-color);">Sign in here</a>
            </p>
        </div>
    </div>

    <!-- JS validation removed to allow backend form submission -->
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9772a6b425326ec2',t:'MTc1NjUzOTc0NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
