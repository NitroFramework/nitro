<?php

use App\Controllers\Auth\ConfirmablePasswordController;
use App\Controllers\Auth\EmailVerificationNotificationController;
use App\Controllers\Auth\EmailVerificationPromptController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\NewPasswordController;
use App\Controllers\Auth\PasswordController;
use App\Controllers\Auth\PasswordResetLinkController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\VerifyEmailController;
use Nitro\Facades\Route;

/*
|------------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------------
*/

// Guest-only auth routes.
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Password reset
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Authenticated auth flows: email verification, password confirmation, updates.
Route::group(['middleware' => 'auth'], function () {
    Route::get('/verify-email', [EmailVerificationPromptController::class, 'show'])->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::post('/password', [PasswordController::class, 'update'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Core pages.
Route::view('/', 'welcome', ['title' => 'NitroPHP'])->name('home');
