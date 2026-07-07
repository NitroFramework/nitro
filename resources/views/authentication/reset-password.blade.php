@extends('layouts.guest', ['title' => 'Reset Password'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Reset password</h1>
    <p class="mt-1 text-sm text-slate-500">Choose a new password for your account.</p>

    <form method="POST" action="/reset-password" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') ?: $email }}" required autofocus
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('email'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('email') }}</p>
            @endif
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">New password</label>
            <input type="password" name="password" id="password" required
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('password'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('password') }}</p>
            @endif
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            Reset password
        </button>
    </form>
@endsection
