<?php

namespace App\Controllers\Auth;

use Nitro\Http\Controller\Controller;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;

/**
 * Breeze-style login: show form, attempt login, logout.
 */
class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): Response
    {
        return view('authentication.signin', [
            'title' => 'Sign In',
            'current_page' => 'signin',
        ]);
    }

    /**
     * Handle a login attempt.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $limiter = app(\Nitro\Cache\RateLimiter::class);
        $key = 'login:' . strtolower((string) request()->input('email')) . '|' . request()->ip();

        // Brute-force lockout: 5 failed attempts per minute per email+IP.
        if ($limiter->tooManyAttempts($key, 5)) {
            $seconds = $limiter->availableIn($key);
            return back()->withInput()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        if (!auth()->attempt(request()->only('email', 'password'))) {
            $limiter->hit($key, 60);
            return back()->withInput()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        // Successful login clears the counter.
        $limiter->clear($key);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Log the user out.
     */
    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
