<?php

namespace App\Controllers\Auth;

use Nitro\Auth\Contracts\MustVerifyEmail;
use Nitro\Http\Controller\BaseController;
use Nitro\Http\Response;

/**
 * Shows the "please verify your email" notice (Laravel's
 * EmailVerificationPromptController). Bounces already-verified users to the
 * dashboard.
 */
class EmailVerificationPromptController extends BaseController
{
    public function show(): Response
    {
        $user = auth()->user();

        if ($user instanceof MustVerifyEmail && $user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('authentication.verify-email', [
            'title'  => 'Verify Email',
            'status' => session('status'),
        ]);
    }
}
