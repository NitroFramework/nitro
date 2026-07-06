<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\Concerns\SendsEmailVerification;
use App\Models\User;
use Nitro\Http\Controller\BaseController;
use Nitro\Http\RedirectResponse;
use Nitro\Http\Response;
use Nitro\Support\Hash;

/**
 * Breeze-style registration: show form, validate, create user, log in, redirect.
 */
class RegisterController extends BaseController
{
    use SendsEmailVerification;

    /**
     * Show the registration form.
     */
    public function showRegistrationForm(): Response
    {
        return view('authentication.signup', [
            'title' => 'Sign Up',
            'current_page' => 'signup',
        ]);
    }

    /**
     * Handle a registration request.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'name'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users,email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(request('password')),
            'status'   => 'active',
        ]);

        auth()->login($user);

        // Fire off the verification email and send the user to the notice; the
        // 'verified' middleware keeps them out of protected areas until done.
        $this->sendVerificationLink($user);

        return redirect()->route('verification.notice');
    }
}
