<footer class="mt-12 border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
    <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-3 px-4 py-6 text-sm text-slate-500 dark:text-slate-400 sm:flex-row sm:items-center sm:px-6 lg:px-8">
        <p>&copy; {{ date('Y') }} NitroPHP — built with the framework.</p>
        <p class="flex items-center gap-4">
            <x-hx-link href="/docs" class="hover:text-slate-900 dark:hover:text-slate-100">Docs</x-hx-link>
            <x-hx-link href="/blade-showcase" class="hover:text-slate-900 dark:hover:text-slate-100">Blade demo</x-hx-link>
            <span class="text-slate-300 dark:text-slate-700">·</span>
            <span>Rendered in @elapsed_time ms</span>
        </p>
    </div>
</footer>
