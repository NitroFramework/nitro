@extends('layouts.guest', ['title' => 'Sign In'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Welcome back</h1>
    <p class="mt-1 text-sm text-slate-500">Sign in to continue.</p>

    <form method="POST" action="/login" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('email'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('email') }}</p>
            @endif
        </div>

        <div>
            <div class="mb-1.5 flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                <a href="/forgot-password" class="text-xs font-medium text-brand-600 hover:underline">Forgot?</a>
            </div>
            <input type="password" name="password" id="password" required
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('password'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('password') }}</p>
            @endif
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            Sign in
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        No account?
        <a href="/register" class="font-semibold text-brand-600 hover:underline">Create one</a>
    </p>
@endsection
