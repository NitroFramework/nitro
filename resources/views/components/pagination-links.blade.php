@php
    $linkClass = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:border-brand-400/50 dark:hover:bg-brand-500/10 dark:hover:text-brand-200';
    $disabledClass = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm font-medium text-slate-400 dark:border-slate-800 dark:bg-slate-900/50 dark:text-slate-600';
    $currentClass = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md bg-brand-600 px-3 py-1.5 text-sm font-semibold text-white dark:bg-brand-500';
    $start = max(1, $paginator->currentPage() - 2);
    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
@endphp

<nav class="flex flex-wrap items-center gap-2">
    @if ($paginator->currentPage() > 1)
        <x-hx-link href="?page=1" :class="$linkClass">First</x-hx-link>
        <x-hx-link href="?page={{ $paginator->currentPage() - 1 }}" :class="$linkClass">Previous</x-hx-link>
    @else
        <span class="{{ $disabledClass }}">First</span>
        <span class="{{ $disabledClass }}">Previous</span>
    @endif

    @for ($i = $start; $i <= $end; $i++)
        @if ($i == $paginator->currentPage())
            <span class="{{ $currentClass }}">{{ $i }}</span>
        @else
            <x-hx-link href="?page={{ $i }}" :class="$linkClass">{{ $i }}</x-hx-link>
        @endif
    @endfor

    @if ($paginator->currentPage() < $paginator->lastPage())
        <x-hx-link href="?page={{ $paginator->currentPage() + 1 }}" :class="$linkClass">Next</x-hx-link>
        <x-hx-link href="?page={{ $paginator->lastPage() }}" :class="$linkClass">Last</x-hx-link>
    @else
        <span class="{{ $disabledClass }}">Next</span>
        <span class="{{ $disabledClass }}">Last</span>
    @endif
</nav>
