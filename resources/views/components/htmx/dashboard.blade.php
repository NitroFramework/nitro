<div class="mx-auto max-w-4xl">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $title }}</h2>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Tests: @@widget embedding, props, session isolation, hx-click nesting, validation, and cross-component events.
    </p>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 1: Toggle widget <span class="font-normal text-slate-400 dark:text-slate-500">(embed, session state, value swap)</span></h5>
        @widget('Toggle')
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 2: Counter widget <span class="font-normal text-slate-400 dark:text-slate-500">(embed, remember/store, value swap)</span></h5>
        @widget('Counter', [], ['counter', 'modals'])
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 3: Tabs widget <span class="font-normal text-slate-400 dark:text-slate-500">(resolveArgs int, session, hx-click with args)</span></h5>
        @widget('Tabs')
    </section>

    <section class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
            <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 4a: Notes — Work <span class="font-normal text-slate-400 dark:text-slate-500">(props, get(), lifecycle)</span></h5>
            @widget('Notes', ['category' => 'work'])
        </div>
        <div>
            <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 4b: Notes — Personal <span class="font-normal text-slate-400 dark:text-slate-500">(same component, different props)</span></h5>
            @widget('Notes', ['category' => 'personal'])
        </div>
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 5: hx-click nesting <span class="font-normal text-slate-400 dark:text-slate-500">(nested clickable elements)</span></h5>
        <div id="nest-outer-target" class="rounded-lg border-2 border-dashed border-slate-300 p-4 dark:border-slate-700">
            <p class="text-sm text-slate-600 dark:text-slate-400">Outer container — click buttons below to test nested hx-click</p>

            <div hx-component="counter" hx-target="#nest-result" hx-swap="innerHTML"
                 class="mt-3 flex items-center gap-2 rounded-lg border border-blue-200 bg-blue-50 p-3 dark:border-blue-500/30 dark:bg-blue-500/10">
                <span class="text-sm dark:text-slate-200">Outer div wrapper —</span>
                <button hx-click="increment" class="rounded-md bg-blue-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-400">
                    Inner button (increment)
                </button>
                <span class="text-sm dark:text-slate-200">— end of outer div</span>
            </div>

            <div id="nest-result" class="mt-3 rounded bg-slate-100 p-2 text-sm dark:bg-slate-800 dark:text-slate-200">
                Click the inner button to test nesting
            </div>
        </div>
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 6: hx-click on TR <span class="font-normal text-slate-400 dark:text-slate-500">(wire/hx attrs on existing element)</span></h5>
        <div id="hxattr-result" class="mb-2 rounded bg-slate-100 p-2 text-sm dark:bg-slate-800 dark:text-slate-200">Click the row below</div>
        <table class="w-full border border-slate-200 dark:border-slate-800">
            <tr class="cursor-pointer border-t border-slate-200 hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-800/40"
                hx-component="counter" hx-click="increment" hx-target="#hxattr-result" hx-swap="innerHTML">
                <td class="p-3 text-sm dark:text-slate-200">This table row has wire attributes directly</td>
                <td class="p-3 text-right text-sm text-brand-600 dark:text-brand-300">Click me →</td>
            </tr>
        </table>
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 7: Contact form <span class="font-normal text-slate-400 dark:text-slate-500">(validate(), errors, old input, emit on success)</span></h5>
        <p class="mb-3 text-sm text-slate-500 dark:text-slate-400">
            Try submitting empty, with invalid email, short message, bad URL, etc. On success it emits
            <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">form-submitted</code>.
        </p>
        @widget('ContactForm')
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 8: Event log <span class="font-normal text-slate-400 dark:text-slate-500">(emit(), HX-Trigger, hx-trigger from:body)</span></h5>
        <p class="mb-3 text-sm text-slate-500 dark:text-slate-400">
            This component listens for <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">form-submitted</code> events.
            Submit the contact form above and watch it update.
        </p>
        @widget('EventLog')
    </section>

    <section class="mt-8">
        <h5 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-100">Test 9: Lazy notes (viewport) <span class="font-normal text-slate-400 dark:text-slate-500">(lazy: 'intersect')</span></h5>
        @widget('Notes', ['category' => 'lazy-test'], lazy: 'intersect')
    </section>
</div>
