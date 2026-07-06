@props([
    'name'    => '',
    'label'   => null,
    'type'    => 'text',
    'value'   => '',
    'error'   => null,
    'help'    => null,
    'required' => false,
])

@php
    $id = $attributes->get('id') ?? ('field-' . $name);
    $base = 'block w-full rounded-md border bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 disabled:cursor-not-allowed disabled:bg-slate-50 dark:bg-slate-900 dark:placeholder:text-slate-500 dark:disabled:bg-slate-800/50';
    $state = $error
        ? 'border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 dark:border-red-500/50 dark:text-red-200 dark:focus:border-red-400 dark:focus:ring-red-400'
        : 'border-slate-300 text-slate-900 focus:border-brand-500 focus:ring-brand-500 dark:border-slate-700 dark:text-slate-100 dark:focus:border-brand-400 dark:focus:ring-brand-400';
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
            {{ $label }}
            @if ($required)<span class="text-red-500 dark:text-red-400">*</span>@endif
        </label>
    @endif

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $id }}"
                  {{ $attributes->except(['id'])->merge(['class' => "$base $state"]) }}>{{ $value }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
               @if ($required) required @endif
               {{ $attributes->except(['id'])->merge(['class' => "$base $state"]) }}>
    @endif

    @if ($error)
        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $error }}</p>
    @elseif ($help)
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $help }}</p>
    @endif
</div>
