@php
    $title = $title ?? '';
    $subTitle = $subTitle ?? '';
@endphp

@if ($title !== '' || $subTitle !== '')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        @if ($title !== '')
            <h1 class="text-xl font-semibold text-slate-900 dark:text-slate-100">{{ $title }}</h1>
        @endif

        @if ($subTitle !== '')
            <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <x-hx-link href="/dashboard" class="hover:text-brand-600 dark:hover:text-brand-300">Dashboard</x-hx-link>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-slate-700 dark:text-slate-200">{{ $subTitle }}</span>
            </nav>
        @endif
    </div>
@endif
