<div id="showcase" hx-component="showcase" class="mx-auto max-w-3xl space-y-4">
    <header>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">HTMX Layer · Showcase</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            One page, every feature. Click around — open the network tab to watch what's going across the wire.
        </p>
    </header>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">Auto-state + #[Computed]</h3>

        <div class="my-3 text-4xl font-bold {{ $isEven ? 'text-blue-600 dark:text-blue-400' : 'text-amber-600 dark:text-amber-400' }}">
            {{ $count }}
            <span class="ml-2 text-sm font-normal text-slate-500 dark:text-slate-400">({{ $isEven ? 'even' : 'odd' }})</span>
        </div>

        <p class="text-sm text-slate-500 dark:text-slate-400">
            Next milestone in <strong class="text-slate-900 dark:text-slate-100">{{ $milestoneNext }}</strong> clicks.
            (<code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">$milestoneNext</code> from with(),
            <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">$isEven</code> from #[Computed].)
        </p>

        <div class="mt-4 flex gap-2">
            <button hx-click="decrement" class="rounded-md bg-slate-100 px-3 py-1.5 text-sm font-medium hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">−</button>
            <button hx-click="increment" class="rounded-md bg-brand-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">+</button>
            <button hx-click="reset"     class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Reset all</button>
        </div>
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">#[Modelable] + validation + emit()</h3>

        @hxErrors($errors ?? null)

        <p class="my-2 text-sm text-slate-500 dark:text-slate-400">
            Type into the input — it auto-binds to <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">$note</code> via hx-model.
            Word count is computed live: <strong class="text-slate-900 dark:text-slate-100">{{ $wordCount }}</strong>.
        </p>

        <input type="text" name="note" hx-model="note" hx-debounce="200" value="{{ $note }}"
               placeholder="Type at least 3 characters then click Save"
               class="mb-2 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-brand-400 dark:focus:ring-brand-400" />

        <button hx-click="save" class="rounded-md bg-brand-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">Save note</button>

        @if (!empty($messages))
            <ul class="mt-3 space-y-1 text-sm text-slate-600 dark:text-slate-400">
                @foreach ($messages as $m)
                    <li><code class="text-slate-400 dark:text-slate-500">{{ $m['time'] }}</code> — {{ $m['text'] }}</li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">skipRender()</h3>
        <p class="my-2 text-sm text-slate-500 dark:text-slate-400">
            logVisit() increments a server-side counter and calls skipRender(), so HTMX won't swap anything — but on the
            next interaction you'll see <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">$logCount</code> reflect the
            click count: <strong class="text-slate-900 dark:text-slate-100">{{ $logCount }}</strong>.
        </p>
        <button hx-click="logVisit" class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Ping (silent)</button>
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">Events</h3>
        <p class="my-2 text-sm text-slate-500 dark:text-slate-400">
            <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">milestone</code> fires every 10 increments;
            <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">note-saved</code> fires when validation passes.
        </p>
        <div id="event-log"
             hx-on:milestone="this.innerHTML += '<div>milestone: ' + event.detail.count + '</div>'"
             hx-on:note-saved="this.innerHTML += '<div>note-saved</div>'"
             class="min-h-[60px] rounded-md bg-slate-900 p-3 font-mono text-xs text-green-400 dark:bg-slate-950 dark:ring-1 dark:ring-slate-800">
        </div>
    </section>
</div>
