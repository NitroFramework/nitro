<div class="text-sm text-slate-600 dark:text-slate-400">
    Showing <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $paginator->firstItem() }}</span>
    to <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $paginator->lastItem() }}</span>
    of <span class="font-semibold text-slate-900 dark:text-slate-100">{{ number_format($paginator->total()) }}</span>
</div>
