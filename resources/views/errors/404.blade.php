@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-lg py-24 text-center">
        <p class="text-sm font-bold uppercase tracking-widest text-brand-600">404</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight sm:text-4xl">Page not found</h1>
        <p class="mt-3 text-base text-slate-600">
            {{ $message ?? "We couldn't find what you were looking for." }}
        </p>
        <a href="/"
            class="mt-7 inline-flex items-center rounded-xl bg-brand-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700">
            ← Back home
        </a>
    </div>
@endsection
