@props(['type' => 'info'])

@php
    $accents = [
        'info'    => 'border-blue-200 bg-blue-50 dark:border-blue-500/30 dark:bg-blue-500/10',
        'success' => 'border-green-200 bg-green-50 dark:border-green-500/30 dark:bg-green-500/10',
        'warning' => 'border-amber-200 bg-amber-50 dark:border-amber-500/30 dark:bg-amber-500/10',
        'danger'  => 'border-red-200 bg-red-50 dark:border-red-500/30 dark:bg-red-500/10',
    ];
    $tone = $accents[$type] ?? $accents['info'];
@endphp

<div class="overflow-hidden rounded-xl border shadow-sm dark:shadow-none {{ $tone }}">
    @if (isset($header))
        <div class="border-b border-slate-200/60 px-5 py-3 text-sm font-semibold text-slate-900 dark:border-white/10 dark:text-slate-100">{{ $header }}</div>
    @endif

    <div class="px-5 py-4 text-sm text-slate-700 dark:text-slate-200">{{ $slot }}</div>

    @if (isset($footer))
        <div class="border-t border-slate-200/60 bg-white/40 px-5 py-3 text-xs text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">{!! $footer !!}</div>
    @endif
</div>
