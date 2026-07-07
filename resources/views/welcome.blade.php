@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-500 via-brand-600 to-indigo-700 px-6 py-20 text-center text-white shadow-2xl shadow-brand-600/30 sm:px-12 sm:py-28">
        <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-16 h-80 w-80 rounded-full bg-violet-500/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-2xl">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest ring-1 ring-white/25">
                ⚡ NitroPHP
            </span>
            <h1 class="mt-7 text-4xl font-extrabold leading-[1.05] tracking-tight sm:text-6xl">
                A lean, fast,<br><span class="text-brand-200">Laravel-shaped</span> PHP framework.
            </h1>
            <p class="mx-auto mt-6 max-w-xl text-base leading-relaxed text-brand-100 sm:text-lg">
                Routing, an Eloquent-style ORM, a Blade-compatible view engine, validation, queues,
                auth, and a reactive HTMX&nbsp;+&nbsp;Livewire layer — on a deliberately small core.
            </p>

            <div class="mt-9 flex flex-wrap items-center justify-center gap-3">
                @auth
                    <a href="/" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-brand-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-brand-50">
                        You're signed in →
                    </a>
                @else
                    <a href="/register" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-brand-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-brand-50">
                        Get started
                    </a>
                    <a href="/login" class="rounded-xl px-6 py-3 text-sm font-semibold text-white ring-1 ring-white/30 transition hover:bg-white/10">
                        Log in
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-lg hover:shadow-slate-200/60">
            <div class="text-2xl">🧩</div>
            <h3 class="mt-4 text-base font-bold">Familiar by design</h3>
            <p class="mt-1.5 text-sm leading-relaxed text-slate-600">
                Controllers, models, migrations, Blade, and validation you already know — swap
                <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-medium text-brand-700">Illuminate</code>
                for <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-medium text-brand-700">Nitro</code>.
            </p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-lg hover:shadow-slate-200/60">
            <div class="text-2xl">⚡</div>
            <h3 class="mt-4 text-base font-bold">Reactive, no SPA</h3>
            <p class="mt-1.5 text-sm leading-relaxed text-slate-600">
                Server-rendered components swapped over the wire with a built-in HTMX layer and a
                from-scratch Livewire-shaped layer.
            </p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-lg hover:shadow-slate-200/60">
            <div class="text-2xl">🛠️</div>
            <h3 class="mt-4 text-base font-bold">Batteries + CLI</h3>
            <p class="mt-1.5 text-sm leading-relaxed text-slate-600">
                The <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-medium text-brand-700">./nitro</code>
                CLI runs migrations, makes components, generates keys, and serves the app.
            </p>
        </div>
    </section>

    <p class="mt-10 text-center text-sm text-slate-500">
        Edit <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-medium text-brand-700">resources/views/welcome.blade.php</code>
        to change this page.
    </p>
@endsection
