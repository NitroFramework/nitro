@fragment('modals')
    <div id="confirm-delete" hidden
         class="m-4 min-h-[80px] rounded-lg bg-red-600 p-4 text-white shadow-lg">
        <p class="mb-2">Are you sure?</p>
        <button class="mr-2 rounded bg-white px-4 py-2 text-red-600 hover:bg-slate-100">Yes</button>
        <button class="rounded bg-slate-800 px-4 py-2 text-white hover:bg-slate-700">Cancel</button>
    </div>
@endfragment

@fragment('counter')
    <div id="counter" hx-component="counter"
        class="mx-auto max-w-md rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Counter</h2>
        <div id="count-display" class="my-4 text-center text-5xl font-extrabold text-brand-600 dark:text-brand-300">
            {{ $count }}</div>
        <div class="flex justify-center gap-2">
            <button hx-click="decrement" hx-target="#count-display" hx-swap="innerHTML"
                class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">−</button>
            <button hx-click="reset"
                class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Reset</button>
            <button hx-click="increment" hx-target="#count-display" hx-swap="innerHTML"
                class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">+</button>
        </div>
    </div>
@endfragment

@fragment('xtags')
    <div class="space-y-4">
        <x-profile-card name="Test 1- Zeeshan Ali" />

        <x-profile-card name="Test 2- Zeeshan Ali" role="Senior Developer" :verified="true" :online="true"
            :postCount="142" class="profile-card--featured" data-id="1">
            Passionate about clean architecture and high-performance PHP.
        </x-profile-card>

        <x-profile-card name="Test 3- Zeeshan Ali" role="Framework Author" :verified="true"
            avatar="https://avatars.githubusercontent.com/u/1?v=4" :postCount="300" />

        <x-profile-card name="Test 4- Zeeshan Ali" role="Senior Developer" :verified="true" :online="true"
            class="profile-card--dark">
            <x-slot:headline>
                <h3 class="text-white">Zeeshan <em>Ali</em></h3>
                <p class="text-slate-400">NitroPHP Creator</p>
            </x-slot:headline>

            Building <strong>NitroPHP</strong> — 119k RPS and counting.

            <x-slot:stats>
                <div class="profile-card__stat">
                    <strong>119k</strong><span>RPS</span>
                </div>
                <div class="profile-card__stat">
                    <strong>300</strong><span>Commits</span>
                </div>
            </x-slot:stats>

            <x-slot:actions>
                <button type="button">Follow</button>
                <button type="button">Message</button>
            </x-slot:actions>
        </x-profile-card>

        <x-profile-card name="Test 5- Guest User" role="Visitor" :verified="false" :online="false" :postCount="0" />
    </div>
@endfragment
