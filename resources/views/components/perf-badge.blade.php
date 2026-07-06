@php
    $hasMetrics = method_exists(\Nitro\PerformanceBar\PerformanceMetrics::class, 'getMemoryUsage');
    $peakMb = $hasMetrics ? number_format(\Nitro\PerformanceBar\PerformanceMetrics::getMemoryUsage(), 2) : null;
@endphp

<div id="perf-badge"
     class="fixed bottom-3 right-3 z-50 flex items-center gap-3 rounded-full border border-slate-700 bg-slate-900/90 px-3 py-1.5 font-mono text-[11px] text-slate-100 shadow-lg backdrop-blur">
    <span class="flex items-center gap-1.5">
        <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
        <span class="text-slate-400">time</span>
        <span class="font-semibold text-white">@elapsed_time ms</span>
    </span>

    @if ($hasMetrics)
        <span class="h-3 w-px bg-slate-700"></span>
        <span class="flex items-center gap-1.5">
            <span class="text-slate-400">mem</span>
            <span class="font-semibold text-white">@memory_usage</span>
        </span>
        <span class="h-3 w-px bg-slate-700"></span>
        <span class="flex items-center gap-1.5">
            <span class="text-slate-400">peak</span>
            <span class="font-semibold text-white">{{ $peakMb }} MB</span>
        </span>
    @endif
</div>
