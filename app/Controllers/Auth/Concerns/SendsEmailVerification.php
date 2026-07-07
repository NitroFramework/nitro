<?php

namespace App\Controllers\Auth\Concerns;

use Nitro\Auth\Contracts\Authenticatable;
use Nitro\Auth\Contracts\MustVerifyEmail;
use Nitro\Mail\Contracts\Mailer;

/**
 * Builds and sends the email-verification link. Shared by registration (send on
 * sign-up) and the resend endpoint so the URL scheme lives in one place.
 *
 * The link is /verify-email/{id}/{sha1(email)} — the hash ties the link to the
 * address, and the route also sits behind 'auth', so only the logged-in owner
 * can consume it.
 */
trait SendsEmailVerification
{
    protected function sendVerificationLink(MustVerifyEmail&Authenticatable $user): void
    {
        $url = rtrim((string) config('app.url', ''), '/')
            . '/verify-email/' . $user->getAuthIdentifier()
            . '/' . sha1($user->getEmailForVerification());

        app(Mailer::class)->raw(
            $user->getEmailForVerification(),
            'Verify your email address',
            "Confirm your email address by visiting the link below:\n\n{$url}\n",
        );
    }
}
