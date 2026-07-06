@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-brand-600 via-brand-700 to-indigo-700 px-6 py-20 text-white sm:px-12 sm:py-28">
        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-10 h-72 w-72 rounded-full bg-indigo-400/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider ring-1 ring-white/20">
                ⚡ A plain-PHP framework
            </span>
            <h1 class="mt-6 text-4xl font-extrabold leading-tight sm:text-5xl">
                NitroPHP — Laravel-grade ergonomics, <span class="text-brand-200">zero magic.</span>
            </h1>
            <p class="mx-auto mt-5 max-w-xl text-base text-brand-100 sm:text-lg">
                A handwritten PHP framework with its own Blade engine, query builder, container, router,
                and HTMX components — no Laravel dependency.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <x-ui.button href="/dashboard" size="lg" variant="secondary">Go to dashboard →</x-ui.button>
                <x-ui.button href="/docs" size="lg" variant="ghost" class="!text-white hover:!bg-white/10">
                    Read the architecture docs
                </x-ui.button>
            </div>
        </div>
    </section>

    <section class="mt-12">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Try it</h2>
        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Every link below hits a real route in this app.</p>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $features = [
                    ['icon' => '🎓', 'title' => 'Students CRUD',     'href' => '/students',       'desc' => 'Models, query builder, pagination, validation, flash errors.'],
                    ['icon' => '👤', 'title' => 'Users',             'href' => '/users',          'desc' => 'Controller + view + form post end-to-end.'],
                    ['icon' => '🔢', 'title' => 'HTMX Counter',      'href' => '/counter',        'desc' => 'Stateful HTMX component with auto state persistence.'],
                    ['icon' => '🧪', 'title' => 'Component showcase','href' => '/showcase',       'desc' => 'Every HTMX attribute the kernel supports.'],
                    ['icon' => '✅', 'title' => 'Todo list',         'href' => '/todo',           'desc' => 'Form binding, validation, partial swaps.'],
                    ['icon' => '🧩', 'title' => 'Blade showcase',    'href' => '/blade-showcase', 'desc' => 'Layouts, stacks, fragments, includes, components.'],
                    ['icon' => '📊', 'title' => 'Dashboard',         'href' => '/dashboard',      'desc' => 'A minimal landing for authenticated users.'],
                    ['icon' => '🛠️', 'title' => 'Test routes',       'href' => '/test',           'desc' => 'Query builder probes, joins, aggregates, transactions.'],
                ];
            @endphp

            @foreach ($features as $f)
                <a href="{{ $f['href'] }}"
                   class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-brand-300 hover:shadow-md dark:border-slate-800 dark:bg-slate-900 dark:shadow-none dark:hover:border-brand-400/50 dark:hover:bg-slate-900/80 dark:hover:shadow-brand-500/5">
                    <div class="text-2xl">{{ $f['icon'] }}</div>
                    <h3 class="mt-3 text-sm font-semibold text-slate-900 group-hover:text-brand-700 dark:text-slate-100 dark:group-hover:text-brand-200">{{ $f['title'] }}</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $f['desc'] }}</p>
                    <span class="mt-3 inline-block text-xs font-medium text-brand-600 group-hover:underline dark:text-brand-300">{{ $f['href'] }} →</span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-ui.card title="Built without Composer-heavy deps">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Just <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs dark:bg-slate-800 dark:text-slate-300">vlucas/phpdotenv</code> and PHPUnit. Everything
                else — Blade engine, container, router, ORM — is in <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs dark:bg-slate-800 dark:text-slate-300">src/</code>.
            </p>
        </x-ui.card>
        <x-ui.card title="HTMX-first, no SPA">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Stateful PHP components rendered on the server, swapped on the client via HTMX. Optional
                Alpine and idiomorph for richer UX.
            </p>
        </x-ui.card>
        <x-ui.card title="Bundled tooling">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                The <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs dark:bg-slate-800 dark:text-slate-300">./nitro</code> CLI runs migrations,
                makes components, clears caches, and serves the app.
            </p>
        </x-ui.card>
    </section>
@endsection
