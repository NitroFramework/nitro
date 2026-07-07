@extends('layouts.guest', ['title' => 'Confirm Password'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Confirm password</h1>
    <p class="mt-1 text-sm text-slate-500">This is a secure area — please confirm your password to continue.</p>

    <form method="POST" action="/confirm-password" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password" id="password" required autofocus
                   class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-4 focus:ring-brand-500/15">
            @if (errors('password'))
                <p class="mt-1.5 text-xs text-red-600">{{ errors('password') }}</p>
            @endif
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            Confirm
        </button>
    </form>
@endsection
