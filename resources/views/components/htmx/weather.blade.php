<div id="weather-widget" hx-component="weather" hx-target="#weather-results" hx-swap="innerHTML"
     class="max-w-md rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

    <h4 class="mb-3 text-base font-semibold text-slate-900">🌤️ Weather lookup</h4>

    <div class="mb-4 flex gap-2">
        <select name="city" hx-change="fetch"
                class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">Select a city...</option>
            <option value="london"  @selected(($city ?? '') === 'london')>London</option>
            <option value="tokyo"   @selected(($city ?? '') === 'tokyo')>Tokyo</option>
            <option value="new_york" @selected(($city ?? '') === 'new_york')>New York</option>
            <option value="dubai"   @selected(($city ?? '') === 'dubai')>Dubai</option>
        </select>

        <button hx-click="fetch" hx-loading="disabled"
                class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 disabled:opacity-50">
            <span hx-loading="hide">Refresh</span>
            <span hx-loading="show">Loading...</span>
        </button>
    </div>

    <div id="weather-results">
        @fragment('weather-results')
            <div hx-loading.class="opacity-50" class="transition-opacity">
                @if (!empty($weather))
                    <div class="flex items-center gap-4 rounded-lg bg-blue-50 p-4">
                        <span class="text-5xl">{{ $weather['icon'] }}</span>
                        <div>
                            <div class="text-2xl font-bold text-slate-900">{{ $weather['temp'] }}°C</div>
                            <div class="text-sm text-slate-600">{{ $weather['condition'] }}</div>
                            <div class="text-xs text-slate-400">{{ $weather['city'] }}</div>
                        </div>
                    </div>
                @else
                    <p class="text-sm italic text-slate-400">Select a city to check the weather.</p>
                @endif
            </div>
        @endfragment
    </div>
</div>
