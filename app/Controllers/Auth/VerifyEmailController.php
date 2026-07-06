<?php

namespace App\Controllers\Auth;

use Nitro\Auth\Contracts\MustVerifyEmail;
use Nitro\Http\Controller\BaseController;
use Nitro\Http\RedirectResponse;

/**
 * Marks the authenticated user's email verified from the link (Laravel's
 * VerifyEmailController). The {id}/{hash} must match the logged-in user; the
 * route is also behind 'auth', so only the owner can verify.
 */
class VerifyEmailController extends BaseController
{
    public function verify(string $id, string $hash): RedirectResponse
    {
        $user = auth()->user();

        if (!$user instanceof MustVerifyEmail) {
            abort(403);
        }

        if (!hash_equals((string) $user->getAuthIdentifier(), $id)) {
            abort(403, 'This verification link is not valid for your account.');
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            abort(403, 'Invalid verification link.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->intended(route('dashboard'))
            ->with('status', 'Your email has been verified.');
    }
}
