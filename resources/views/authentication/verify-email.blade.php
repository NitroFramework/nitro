@extends('layouts.guest', ['title' => 'Verify Email'])

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Verify your email</h1>
    <p class="mt-1 text-sm text-slate-500">
        Thanks for signing up! Click the link in the email we just sent to verify your address.
        (In local dev the link is written to <code class="rounded bg-slate-100 px-1 py-0.5 text-xs text-brand-700">storage/logs/mail.log</code>.)
    </p>

    @if ($status === 'verification-link-sent')
        <div class="mt-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            A fresh verification link has been sent.
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-3">
        <form method="POST" action="/email/verification-notification">
            @csrf
            <button type="submit"
                    class="rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-500/25">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-sm font-semibold text-slate-600 hover:underline">Log out</button>
        </form>
    </div>
@endsection
