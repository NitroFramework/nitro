<div id="live-stats" hx-component="liveStats"
     class="max-w-lg rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-base font-semibold text-slate-900">📊 Live stats</h4>
        <span class="text-xs text-slate-400">Auto-refreshes every 3s • Last: {{ $lastUpdated ?? '--:--:--' }}</span>
    </div>

    @if (!empty($stats))
        <div class="mb-4 grid grid-cols-3 gap-3">
            <div class="rounded-lg bg-blue-50 p-3 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['visitors'] }}</div>
                <div class="text-xs text-slate-500">Visitors</div>
            </div>
            <div class="rounded-lg bg-green-50 p-3 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $stats['orders'] }}</div>
                <div class="text-xs text-slate-500">Orders</div>
            </div>
            <div class="rounded-lg bg-amber-50 p-3 text-center">
                <div class="text-2xl font-bold text-amber-600">${{ $stats['revenue'] }}</div>
                <div class="text-xs text-slate-500">Revenue</div>
            </div>
        </div>

        <div class="text-sm text-slate-600">
            <strong class="text-slate-900">Recent activity:</strong>
            <ul class="mt-1 list-disc space-y-0.5 pl-5">
                @foreach ($stats['activity'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="py-8 text-center text-slate-400">
            <div class="mb-2 text-3xl">⏳</div>
            Loading stats...
        </div>
    @endif

    <div class="mt-4 flex gap-2">
        <button hx-click="refresh"
                class="rounded-md bg-blue-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-600">
            Manual refresh
        </button>
        <button hx-click="resetCounters"
                class="rounded-md border border-slate-300 bg-slate-50 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
            Reset counters
        </button>
    </div>
</div>
