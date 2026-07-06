<div hx-component="counterPlain"
     class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
    <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">CounterPlain</h2>
    <p class="mb-3 text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
        no attribute — full re-render
    </p>

    <div class="my-4 text-center">
        <div class="text-5xl font-extrabold text-amber-600 dark:text-amber-300">{{ $count }}</div>
        <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">
            full view returned on every action
        </div>
    </div>

    {{-- No hx-target / hx-swap on buttons: they fall back to the envelope's
         hx-target="closest [data-hxid]" + hx-swap="outerHTML", so each
         click replaces the whole envelope with the freshly rendered view. --}}
    <div class="flex justify-center gap-2">
        <button hx-click="decrement"
            class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">−</button>
        <button hx-click="reset"
            class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Reset</button>
        <button hx-click="increment"
            class="rounded-md bg-amber-600 px-4 py-2 text-sm font-medium text-white hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-400">+</button>
    </div>
</div>
