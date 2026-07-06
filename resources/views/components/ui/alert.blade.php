@props([
    'variant' => 'info',
    'title'   => null,
])

@php
    $variants = [
        'info'    => 'bg-blue-50 text-blue-900 border-blue-200 dark:bg-blue-500/10 dark:text-blue-200 dark:border-blue-500/30',
        'success' => 'bg-green-50 text-green-900 border-green-200 dark:bg-green-500/10 dark:text-green-200 dark:border-green-500/30',
        'warning' => 'bg-amber-50 text-amber-900 border-amber-200 dark:bg-amber-500/10 dark:text-amber-200 dark:border-amber-500/30',
        'error'   => 'bg-red-50 text-red-900 border-red-200 dark:bg-red-500/10 dark:text-red-200 dark:border-red-500/30',
    ];
    $classes = 'rounded-md border px-4 py-3 text-sm ' . ($variants[$variant] ?? $variants['info']);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="alert">
    @if ($title)
        <p class="mb-1 font-semibold">{{ $title }}</p>
    @endif
    <div>{{ $slot }}</div>
</div>
