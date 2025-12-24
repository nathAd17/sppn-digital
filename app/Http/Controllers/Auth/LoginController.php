<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Username atau email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        // Check if user is active
        $user = \App\Models\User::where($loginType, $request->login)->first();

        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                'login' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
            ]);
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->log('User logged in');

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Selamat datang, ' . Auth::user()->name);
        }

        throw ValidationException::withMessages([
            'login' => 'Username/email atau password salah.',
        ]);
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        // Log activity
        activity()
            ->causedBy(Auth::user())
            ->log('User logged out');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah logout');
    }
}
