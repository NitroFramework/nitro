<div id="tabs-component" hx-component="tabs" class="mx-auto max-w-3xl">
    <div class="mb-5 flex gap-0 border-b-2 border-slate-200 dark:border-slate-800">
        @foreach ($tabs as $id => $tab)
            @php
                $isActive = $activeTab === $id;
            @endphp
            <div hx-click="select({{ $id }})"
                 class="cursor-pointer select-none border-b-[3px] px-6 py-3 text-sm transition
                        {{ $isActive
                            ? 'border-brand-600 font-semibold text-brand-600 dark:border-brand-400 dark:text-brand-300'
                            : 'border-transparent text-slate-600 hover:bg-slate-50 dark:text-slate-400 dark:hover:bg-slate-800/40' }}">
                <span>{{ $tab['icon'] }} {{ $tab['title'] }}</span>
            </div>
        @endforeach
    </div>

    <div class="min-h-[100px] rounded-lg bg-slate-50 p-5 text-slate-700 dark:bg-slate-800/40 dark:text-slate-200">
        {!! $content !!}
    </div>
</div>
