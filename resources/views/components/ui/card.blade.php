@props([
    'title'  => null,
    'action' => null,
    'padded' => true,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none']) }}>
    @if ($title || $action)
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-3 dark:border-slate-800">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $title }}</h3>
            @if ($action)
                <div class="text-sm">{{ $action }}</div>
            @endif
        </div>
    @endif

    <div class="{{ $padded ? 'p-5' : '' }}">
        {{ $slot }}
    </div>
</div>
