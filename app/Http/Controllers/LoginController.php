<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $login = $request->input('login');
            $password = $request->input('password');
            $remember = $request->boolean('remember');

            $user = User::where('email', $login)
                ->orWhere('phone', $login)
                ->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user, $remember);
                
                // Regenerate session for security
                $request->session()->regenerate();
                
                // Redirect based on user role
                if ($user->is_admin) {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('home'); // Regular users go to frontend
                }
            } else {
                return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
            }
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        $wasAdmin = Auth::user() && Auth::user()->is_admin;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to appropriate login page
        if ($wasAdmin) {
            return redirect()->route('admin.login');
        }
        return redirect()->route('home');
    }
}
