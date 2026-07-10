<?php

namespace App\Controllers\Auth;

use Nitro\Auth\Passwords\PasswordBroker;
use Nitro\Http\Controller\Controller;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;
use Nitro\Support\Hash;

/**
 * Handles choosing a new password from a reset link (Laravel's NewPasswordController).
 */
class NewPasswordController extends Controller
{
    /** Show the reset form for a given token (email comes from the query string). */
    public function create(string $token): Response
    {
        return view('authentication.reset-password', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => (string) request('email', ''),
        ]);
    }

    /** Validate the token and set the new password. */
    public function store(): RedirectResponse
    {
        request()->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $status = app(PasswordBroker::class)->reset(
            request()->only('email', 'password', 'token'),
            function ($user, string $password) {
                $user->update(['password' => Hash::make($password)]);
            },
        );

        if ($status === PasswordBroker::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'Your password has been reset. Please sign in.');
        }

        return back()->withInput()->withErrors([
            'email' => 'This password reset token is invalid or has expired.',
        ]);
    }
}
