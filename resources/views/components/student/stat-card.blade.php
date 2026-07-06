@props(['label', 'value'])

<div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
    <div class="text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ $label }}</div>
    <div class="mt-2 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $value }}</div>
</div>
