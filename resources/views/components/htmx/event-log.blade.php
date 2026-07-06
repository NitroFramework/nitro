<div id="event-log-widget" hx-component="eventLog"
     hx-on:form-submitted="log('form-submitted', 'Contact form was submitted')"
     class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">

    <div class="mb-3 flex items-center justify-between">
        <h4 class="text-base font-semibold text-slate-900 dark:text-slate-100">📡 Event log</h4>
        @if (!empty($log))
            <button hx-click="clear"
                    class="rounded-md border border-slate-300 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-200 dark:hover:bg-slate-800">
                Clear
            </button>
        @endif
    </div>

    <p class="mb-3 text-xs text-slate-400 dark:text-slate-500">
        Listening for: <code class="rounded bg-slate-100 px-1 text-xs dark:bg-slate-800 dark:text-slate-300">form-submitted</code> events from other components
    </p>

    @if (empty($log))
        <p class="text-sm italic text-slate-400 dark:text-slate-500">No events captured yet. Submit the contact form to see events appear here.</p>
    @else
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-slate-200 dark:border-slate-800">
                    <th class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">Time</th>
                    <th class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">Event</th>
                    <th class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach (array_reverse($log) as $entry)
                    <tr>
                        <td class="px-2 py-2 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $entry['time'] }}</td>
                        <td class="px-2 py-2"><code class="rounded bg-blue-50 px-1.5 py-0.5 text-xs text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">{{ $entry['event'] }}</code></td>
                        <td class="px-2 py-2 text-slate-600 dark:text-slate-300">{{ $entry['detail'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
