<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Kagzi Admin Panel</title>
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
            background-color: var(--theme-color-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(151, 126, 255, 0.4);
        }
        
        .checkbox {
            accent-color: var(--accent-color);
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
            <div class="mb-4 flex justify-center">
                <img src="/Kagziinfotech.png" alt="Kagzi Admin" class="h-8 object-contain">
            </div>
            <p class="text-sm mt-2" style="color: var(--text-secondary);">Sign in to your administrator account</p>
        </div>

        <form id="loginForm" class="space-y-6" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <label for="login" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Email or Phone Number</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    required
                    class="input w-full"
                    placeholder="Enter your email or phone number"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="input w-full pr-12"
                        placeholder="Enter your password"
                    >
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 hover:text-gray-700 transition-colors"
                        style="background:transparent;border:none;padding:0;margin:0;color: var(--text-secondary);"
                        tabindex="-1"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="checkbox rounded" style="border: 1px solid var(--border-color);">
                    <span class="ml-2 text-sm" style="color: var(--text-secondary);">Remember me</span>
                </label>
                {{-- <a href="#" class="text-sm font-medium hover:underline" style="color: var(--accent-color);">Forgot password?</a> --}}
            </div>

            <!-- Admin Credentials Info -->
            {{-- <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm">
                <strong>Admin Login:</strong><br>
                Email: admin@kagzi.com<br>
                Password: admin123
            </div> --}}

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div id="errorMessage" class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"></div>
            <div id="successMessage" class="hidden bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm"></div>

            <button
                type="submit"
                class="btn btn-primary w-full"
            >
                <i class="fas fa-sign-in-alt mr-2"></i>
                Sign In to Dashboard
            </button>
        </form>

        {{-- <div class="mt-6 text-center">
            <p class="text-sm" style="color: var(--text-secondary);">
                Don't have an administrator account?
                <a href="{{ route('register')}}" class="font-medium hover:underline" style="color: var(--accent-color);">Register here</a>
            </p>
        </div> --}}
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        });
    </script>
</body>
</html>
