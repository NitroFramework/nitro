<?php

namespace App\Controllers\Auth;

use Nitro\Http\Controller\BaseController;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;

/**
 * Breeze-style login: show form, attempt login, logout.
 */
class LoginController extends BaseController
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

        if (!auth()->attempt(request()->only('email', 'password'))) {
            return back()->withInput()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

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
