<div id="command-palette" hx-component="commandPalette" hx-target="#command-palette" hx-swap="morph:outerHTML"
     class="max-w-md rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

    <h4 class="mb-2 text-base font-semibold text-slate-900">⌨️ Command palette</h4>
    <p class="mb-3 text-xs text-slate-400">
        Type to filter,
        <kbd class="rounded border border-slate-300 bg-slate-100 px-1.5 py-0.5 text-[10px] font-mono">Enter</kbd> to execute,
        <kbd class="rounded border border-slate-300 bg-slate-100 px-1.5 py-0.5 text-[10px] font-mono">↑</kbd>
        <kbd class="rounded border border-slate-300 bg-slate-100 px-1.5 py-0.5 text-[10px] font-mono">↓</kbd> to navigate,
        <kbd class="rounded border border-slate-300 bg-slate-100 px-1.5 py-0.5 text-[10px] font-mono">Esc</kbd> to clear
    </p>

    <input id="command-input" type="text" name="query" value="{{ $query ?? '' }}"
           placeholder="Type a command..." autocomplete="off"
           hx-model="query" hx-debounce="150"
           hx-keydown.enter="execute" hx-keydown.up="moveUp" hx-keydown.down="moveDown" hx-keyup.escape="clear"
           class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500" />

    @if (!empty($commands))
        <ul class="mt-2 overflow-hidden rounded-lg border border-slate-200">
            @foreach ($commands as $i => $cmd)
                @php
                    $isSelected = $i === ($selected ?? 0);
                @endphp
                <li hx-click="run({{ $i }})"
                    class="flex cursor-pointer items-center justify-between px-4 py-2.5
                           {{ $i > 0 ? 'border-t border-slate-100' : '' }}
                           {{ $isSelected ? 'bg-blue-50 text-blue-700' : 'bg-white text-slate-600 hover:bg-slate-50' }}">
                    <span>
                        <span class="mr-2">{{ $cmd['icon'] }}</span>
                        {{ $cmd['label'] }}
                    </span>
                    <span class="text-xs text-slate-400">{{ $cmd['shortcut'] ?? '' }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
