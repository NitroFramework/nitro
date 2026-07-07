<?php

namespace App\Controllers\Auth;

use Nitro\Auth\Passwords\PasswordBroker;
use Nitro\Http\Controller\BaseController;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;
use Nitro\Mail\Contracts\Mailer;

/**
 * Handles requesting a password-reset link (Laravel's PasswordResetLinkController).
 */
class PasswordResetLinkController extends BaseController
{
    /** Show the "forgot password" form. */
    public function create(): Response
    {
        return view('authentication.forgot-password', [
            'title' => 'Forgot Password',
        ]);
    }

    /** Validate the email and send a reset link (always reporting success). */
    public function store(): RedirectResponse
    {
        request()->validate(['email' => 'required|email']);

        // Throttle reset requests (per email + IP) so the endpoint can't be used
        // to bomb an inbox with reset emails.
        $limiter = app(\Nitro\Cache\RateLimiter::class);
        $key = 'password-reset:' . strtolower((string) request('email')) . '|' . request()->ip();

        if ($limiter->tooManyAttempts($key, 3)) {
            $seconds = $limiter->availableIn($key);
            return back()->withInput()->withErrors([
                'email' => "Too many reset requests. Please try again in {$seconds} seconds.",
            ]);
        }
        $limiter->hit($key, 60);

        app(PasswordBroker::class)->sendResetLink(
            request()->only('email'),
            function ($user, string $token) {
                $email = (string) request('email');
                $url = rtrim((string) config('app.url', ''), '/')
                    . '/reset-password/' . $token
                    . '?email=' . urlencode($email);

                app(Mailer::class)->raw(
                    $email,
                    'Reset your password',
                    "Reset your password using the link below:\n\n{$url}\n",
                );
            },
        );

        // Same response whether or not the email exists — no account enumeration.
        return back()->with('status', 'If that account exists, a reset link has been sent.');
    }
}
