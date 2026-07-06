@props(['type', 'label'])

@php
    $palette = [
        'active'    => 'bg-green-100 text-green-800 ring-green-600/20 dark:bg-green-500/15 dark:text-green-300 dark:ring-green-400/30',
        'inactive'  => 'bg-red-100 text-red-800 ring-red-600/20 dark:bg-red-500/15 dark:text-red-300 dark:ring-red-400/30',
        'graduated' => 'bg-blue-100 text-blue-800 ring-blue-600/20 dark:bg-blue-500/15 dark:text-blue-300 dark:ring-blue-400/30',
        'suspended' => 'bg-amber-100 text-amber-800 ring-amber-600/20 dark:bg-amber-500/15 dark:text-amber-300 dark:ring-amber-400/30',
        'male'      => 'bg-indigo-100 text-indigo-800 ring-indigo-600/20 dark:bg-indigo-500/15 dark:text-indigo-300 dark:ring-indigo-400/30',
        'female'    => 'bg-pink-100 text-pink-800 ring-pink-600/20 dark:bg-pink-500/15 dark:text-pink-300 dark:ring-pink-400/30',
        'other'     => 'bg-slate-100 text-slate-800 ring-slate-600/20 dark:bg-slate-700/50 dark:text-slate-300 dark:ring-slate-500/30',
    ];
    $tone = $palette[$type] ?? 'bg-slate-100 text-slate-800 ring-slate-600/20 dark:bg-slate-700/50 dark:text-slate-300 dark:ring-slate-500/30';
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium uppercase tracking-wide ring-1 ring-inset {{ $tone }}">
    {{ $label }}
</span>
