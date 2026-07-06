<div id="toggle-widget" hx-component="toggle"
     class="inline-flex items-center gap-3 rounded-lg border border-slate-200 bg-white px-5 py-3 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
    <span class="text-sm text-slate-600 dark:text-slate-300">Power</span>

    <button hx-click="flip" type="button"
            class="relative h-6 w-12 rounded-full transition-colors {{ $on ? 'bg-green-500 dark:bg-green-400' : 'bg-slate-300 dark:bg-slate-700' }}">
        <span class="absolute top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform
                     {{ $on ? 'translate-x-6' : 'translate-x-0.5' }}"></span>
    </button>

    <span class="font-semibold {{ $on ? 'text-green-600 dark:text-green-400' : 'text-slate-400 dark:text-slate-500' }}">
        {{ $on ? 'ON' : 'OFF' }}
    </span>
</div>
