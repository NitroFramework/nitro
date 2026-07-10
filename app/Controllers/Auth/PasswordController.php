<?php

namespace App\Controllers\Auth;

use Nitro\Http\Controller\Controller;
use Nitro\Http\RedirectResponse;
use Nitro\Support\Hash;

/**
 * Updates the authenticated user's password from a profile/settings page
 * (Laravel's PasswordController). Requires the current password.
 */
class PasswordController extends Controller
{
    public function update(): RedirectResponse
    {
        request()->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (!auth()->validatePassword(request('current_password'))) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        auth()->user()->update([
            'password' => Hash::make(request('password')),
        ]);

        return back()->with('status', 'password-updated');
    }
}
