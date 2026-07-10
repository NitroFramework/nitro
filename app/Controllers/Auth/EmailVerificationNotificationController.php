<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\Concerns\SendsEmailVerification;
use Nitro\Auth\Contracts\Authenticatable;
use Nitro\Auth\Contracts\MustVerifyEmail;
use Nitro\Http\Controller\Controller;
use Nitro\Http\RedirectResponse;

/**
 * Resends the email-verification link (Laravel's
 * EmailVerificationNotificationController).
 */
class EmailVerificationNotificationController extends Controller
{
    use SendsEmailVerification;

    public function store(): RedirectResponse
    {
        $user = auth()->user();

        if ($user instanceof MustVerifyEmail && $user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard'));
        }

        if ($user instanceof MustVerifyEmail && $user instanceof Authenticatable) {
            $this->sendVerificationLink($user);
        }

        return back()->with('status', 'verification-link-sent');
    }
}
