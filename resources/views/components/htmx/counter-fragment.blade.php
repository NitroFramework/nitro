{{--
    CounterFragment view — mode-aware via embed-site override metadata.

    The component class declares NO #[RenderValue]/#[RenderFragment]
    attribute; the embed site picks the shape via value: / fragments: / full:
    and viewData surfaces the active override (renderValueProperty) so the
    view can wire the right swap target for each mode.

      value: override     → display gets a per-instance id, buttons swap
                            its innerHTML with the scalar response.
      fragments / full    → buttons inherit closest [data-hxid] outerHTML
                            from the envelope (multi-instance safe).
--}}
@php
    $isValueMode   = ($renderValueProperty ?? null) !== null;
    $valueTargetId = $isValueMode ? 'hxv-' . ($hxId ?? '') : null;

    $modeLabel = match (true) {
        $isValueMode                   => "embed: value: '{$renderValueProperty}'",
        !empty($forceFullRender)       => 'embed: full: true',
        is_array($renderFragments ?? null) => 'embed: fragments: [' . implode(',', $renderFragments) . ']',
        default                        => 'embed: (no override) — full view',
    };
@endphp

<div hx-component="counterFragment">
    @fragment('display')
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">CounterFragment</h2>
            <p class="mb-3 text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                {{ $modeLabel }}
            </p>

            <div class="my-4 text-center">
                @if ($isValueMode)
                    <span id="{{ $valueTargetId }}" class="block text-5xl font-extrabold text-brand-600 dark:text-brand-300">{{ $count }}</span>
                @else
                    <div class="text-5xl font-extrabold text-brand-600 dark:text-brand-300">{{ $count }}</div>
                @endif
                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    {{ $count === 0 ? 'zero' : ($count > 0 ? 'positive' : 'negative') }}
                </div>
            </div>

            <div class="flex justify-center gap-2">
                <button hx-click="decrement"
                    @if ($isValueMode) hx-target="#{{ $valueTargetId }}" hx-swap="innerHTML" @endif
                    class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">−</button>
                <button hx-click="reset"
                    @if ($isValueMode) hx-target="#{{ $valueTargetId }}" hx-swap="innerHTML" @endif
                    class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Reset</button>
                <button hx-click="increment"
                    @if ($isValueMode) hx-target="#{{ $valueTargetId }}" hx-swap="innerHTML" @endif
                    class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">+</button>
            </div>
        </div>
    @endfragment
</div>
