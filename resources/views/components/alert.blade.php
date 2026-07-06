@props(['type' => 'info'])

@php
    $variants = [
        'info'    => 'border-blue-200 bg-blue-50 text-blue-900 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-200',
        'success' => 'border-green-200 bg-green-50 text-green-900 dark:border-green-500/30 dark:bg-green-500/10 dark:text-green-200',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-900 dark:border-amber-500/30 dark:bg-amber-500/10 dark:text-amber-200',
        'danger'  => 'border-red-200 bg-red-50 text-red-900 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-200',
    ];
    $tone = $variants[$type] ?? $variants['info'];
@endphp

<div class="rounded-md border px-4 py-3 text-sm {{ $tone }}" role="alert">
    @if (isset($slots['title']))
        <p class="mb-1 font-semibold">{{ $slots['title'] }}</p>
    @endif
    <div>{{ $message ?? $slot }}</div>
</div>
