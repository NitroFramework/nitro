@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-lg py-16 text-center">
        <p class="text-sm font-semibold text-brand-600 dark:text-brand-300">404</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-slate-100">Page not found</h1>
        <p class="mt-3 text-base text-slate-600 dark:text-slate-400">
            Sorry, we couldn't find what you were looking for.
        </p>
        <div class="mt-6 flex items-center justify-center gap-3">
            <x-ui.button href="/" variant="primary">Go home</x-ui.button>
            <x-ui.button href="/dashboard" variant="outline">Dashboard</x-ui.button>
        </div>
    </div>
@endsection
