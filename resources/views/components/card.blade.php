@props(['color' => '#ffffff', 'title' => null])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-slate-200 shadow-sm dark:border-slate-800 dark:shadow-none']) }}
     style="background: {{ $color }}">
    @if ($title)
        <div class="border-b border-slate-200/60 px-5 py-3 text-sm font-semibold text-slate-900 dark:border-slate-700/60 dark:text-slate-900">{{ $title }}</div>
    @endif

    @if (isset($slots['header']))
        <div class="border-b border-slate-200/60 px-5 py-3 text-sm font-semibold text-slate-900 dark:border-slate-700/60 dark:text-slate-900">{{ $slots['header'] }}</div>
    @endif

    <div class="px-5 py-4 text-sm text-slate-700 dark:text-slate-800">
        {{ $slot }}
    </div>

    @if (isset($slots['footer']))
        <div class="border-t border-slate-200/60 bg-white/40 px-5 py-3 text-xs text-slate-600 dark:border-slate-700/60 dark:bg-white/30 dark:text-slate-700">
            {{ $slots['footer'] }}
        </div>
    @endif
</div>
