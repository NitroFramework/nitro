@extends('layouts.guest', ['title' => 'Sign Up'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
    <p class="mt-1 text-sm text-slate-500">Takes less than a minute.</p>

    <form method="POST" action="/register" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('name'))<p class="mt-1.5 text-xs text-red-600">{{ errors('name') }}</p>@endif
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('email'))<p class="mt-1.5 text-xs text-red-600">{{ errors('email') }}</p>@endif
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password" id="password" required minlength="8"
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('password'))<p class="mt-1.5 text-xs text-red-600">{{ errors('password') }}</p>@endif
            <p class="mt-1.5 text-xs text-slate-500">Minimum 8 characters.</p>
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            Create account
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Already registered?
        <a href="/login" class="font-semibold text-brand-600 hover:underline">Sign in</a>
    </p>
@endsection
