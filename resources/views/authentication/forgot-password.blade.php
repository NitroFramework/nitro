@extends('layouts.guest', ['title' => 'Forgot Password'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Forgot your password?</h1>
    <p class="mt-1 text-sm text-slate-500">Enter your email and we'll send you a reset link.</p>

    @if (session('status'))
        <div class="mt-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="/forgot-password" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('email'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('email') }}</p>
            @endif
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            Email password reset link
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Remembered it?
        <a href="/login" class="font-semibold text-brand-600 hover:underline">Back to sign in</a>
    </p>
@endsection
