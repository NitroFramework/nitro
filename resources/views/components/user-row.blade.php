<div class="flex items-center justify-between border-b border-slate-100 px-3 py-3 dark:border-slate-800">
    <div>
        <strong class="text-sm text-slate-900 dark:text-slate-100">{{ $name }}</strong>
        <div class="text-xs text-slate-500 dark:text-slate-400">
            {{ $slot }}
        </div>
    </div>

    <div class="flex items-center gap-2">
        {{ $actions }}
    </div>
</div>
