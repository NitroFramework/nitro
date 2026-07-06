@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl">
        <h2 class="text-2xl font-bold text-slate-900">Attribute showcase</h2>
        <p class="mt-1 text-sm text-slate-500">
            Examples for: <code class="rounded bg-slate-100 px-1 text-xs">hx-loading</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-change</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-model.defer</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-keydown</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-keyup</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-poll</code>,
            <code class="rounded bg-slate-100 px-1 text-xs">hx-init</code>
        </p>

        <section class="mt-8">
            <h5 class="mb-2 text-sm font-semibold text-slate-900">Example 1: Weather lookup <span class="font-normal text-slate-400">(hx-change, hx-loading, hx-loading.class)</span></h5>
            <p class="mb-3 text-sm text-slate-500">Select a city to fetch weather. Watch the button disable, text swap, and results fade during the request.</p>
            @widget('Weather')
        </section>

        <section class="mt-8">
            <h5 class="mb-2 text-sm font-semibold text-slate-900">Example 2: Profile settings <span class="font-normal text-slate-400">(hx-model.defer, flush on action)</span></h5>
            <p class="mb-3 text-sm text-slate-500">Type in any field — no requests fire. Click Save and all values send together.</p>
            @widget('Settings')
        </section>

        <section class="mt-8">
            <h5 class="mb-2 text-sm font-semibold text-slate-900">Example 3: Command palette <span class="font-normal text-slate-400">(hx-keydown.enter, hx-keydown.up/down, hx-keyup.escape)</span></h5>
            <p class="mb-3 text-sm text-slate-500">Focus the input. Use arrow keys to navigate, Enter to execute, Escape to clear.</p>
            @widget('CommandPalette')
        </section>

        <section class="mt-8">
            <h5 class="mb-2 text-sm font-semibold text-slate-900">Example 4: Live stats <span class="font-normal text-slate-400">(hx-init, hx-poll)</span></h5>
            <p class="mb-3 text-sm text-slate-500">Loads on mount via <code class="rounded bg-slate-100 px-1 text-xs">hx-init</code>, then auto-refreshes every 3 seconds via <code class="rounded bg-slate-100 px-1 text-xs">hx-poll</code>.</p>
            @widget('LiveStats')
        </section>

        <section class="mt-8">
            @include('components.htmx.hxtoggle')
        </section>
    </div>
@endsection
