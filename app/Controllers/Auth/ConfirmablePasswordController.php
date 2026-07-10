<?php

namespace App\Controllers\Auth;

use Nitro\Http\Controller\Controller;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;

/**
 * Confirms the user's password before entering a sensitive area (Laravel's
 * ConfirmablePasswordController). Records the confirmation time in the session;
 * the 'password.confirm' middleware reads it.
 */
class ConfirmablePasswordController extends Controller
{
    public function show(): Response
    {
        return view('authentication.confirm-password', [
            'title' => 'Confirm Password',
        ]);
    }

    public function store(): RedirectResponse
    {
        request()->validate(['password' => 'required']);

        if (!auth()->validatePassword(request('password'))) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        session(['auth.password_confirmed_at' => time()]);

        return redirect()->intended(route('dashboard'));
    }
}
