@php
    $priorityBadge = [
        'low'    => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300',
        'medium' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300',
        'high'   => 'bg-red-100 text-red-700 dark:bg-red-500/15 dark:text-red-300',
    ];
    $statusKeys = array_keys($statuses ?? []);
@endphp

<div id="task-board" hx-component="taskBoard"
     hx-target="#task-board" hx-swap="morph:outerHTML"
     class="mx-auto max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">

    {{-- Header + stats --}}
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">📋 Task board</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                {{ $done ?? 0 }} of {{ $total ?? 0 }} done · {{ $completion ?? 0 }}% complete
                @if (($showing ?? 0) !== ($total ?? 0))
                    · <span class="text-brand-600 dark:text-brand-300">{{ $showing ?? 0 }} shown</span>
                @endif
            </p>
            <div class="mt-2 h-1.5 w-48 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                <div class="h-full rounded-full bg-brand-500 transition-all" style="width: {{ $completion ?? 0 }}%"></div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button hx-click="clearDone" hx-confirm="Remove all completed tasks?"
                    class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                Clear done
            </button>
            <button hx-click="reset"
                    class="rounded-md bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500/20">
                Reset
            </button>
        </div>
    </div>

    {{-- Add-task form --}}
    <form hx-submit="add" class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/40">
        @hxErrors($errors ?? null)

        <div class="flex flex-wrap items-start gap-2">
            <div class="min-w-[200px] flex-1">
                <input type="text" hx-model.defer="newTitle" value="{{ $newTitle ?? '' }}" placeholder="New task title…"
                       class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" />
                @hxError('newTitle')
            </div>

            <select hx-model.defer="newPriority"
                    class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                <option value="low"    @selected(($newPriority ?? 'medium') === 'low')>Low</option>
                <option value="medium" @selected(($newPriority ?? 'medium') === 'medium')>Medium</option>
                <option value="high"   @selected(($newPriority ?? 'medium') === 'high')>High</option>
            </select>

            <input type="text" hx-model.defer="newAssignee" value="{{ $newAssignee ?? '' }}" placeholder="Assignee"
                   class="w-36 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" />

            <button type="submit" hx-loading="disabled"
                    class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 disabled:opacity-50 dark:bg-brand-500 dark:hover:bg-brand-400">
                Add task
            </button>
        </div>
    </form>

    {{-- Filters --}}
    <div class="mt-5 flex flex-wrap items-center gap-2">
        <input type="text" hx-model="search" hx-debounce="300" value="{{ $search ?? '' }}"
               placeholder="Search title or assignee…" autocomplete="off"
               class="block w-full min-w-[220px] flex-1 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" />

        <select hx-model="statusFilter"
                class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
            <option value="all"   @selected(($statusFilter ?? 'all') === 'all')>All statuses</option>
            <option value="todo"  @selected(($statusFilter ?? 'all') === 'todo')>To do</option>
            <option value="doing" @selected(($statusFilter ?? 'all') === 'doing')>In progress</option>
            <option value="done"  @selected(($statusFilter ?? 'all') === 'done')>Done</option>
        </select>
    </div>

    {{-- Columns --}}
    <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach (($columns ?? []) as $key => $column)
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-950/40">
                <div class="mb-3 flex items-center justify-between px-1">
                    <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $column['label'] }}</h3>
                    <span class="rounded-full bg-slate-200 px-2 py-0.5 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ count($column['tasks']) }}</span>
                </div>

                <div class="space-y-2">
                    @forelse ($column['tasks'] as $task)
                        @php $idx = array_search($task['status'], $statusKeys, true); @endphp
                        <div class="rounded-lg border border-slate-200 bg-white p-3 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $task['title'] }}</p>
                                <button hx-click="remove({{ $task['id'] }})" hx-confirm="Delete this task?"
                                        class="shrink-0 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400" title="Delete">✕</button>
                            </div>

                            <div class="mt-2 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <button hx-click="cyclePriority({{ $task['id'] }})" title="Cycle priority"
                                            class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $priorityBadge[$task['priority']] ?? $priorityBadge['low'] }}">
                                        {{ ucfirst($task['priority']) }}
                                    </button>
                                    <span class="text-xs text-slate-400 dark:text-slate-500">{{ $task['assignee'] }}</span>
                                </div>

                                <div class="flex items-center gap-1">
                                    @if ($idx > 0)
                                        <button hx-click="move({{ $task['id'] }}, '{{ $statusKeys[$idx - 1] }}')"
                                                class="rounded px-1.5 py-0.5 text-sm text-slate-400 hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200" title="Move left">←</button>
                                    @endif
                                    @if ($idx < count($statusKeys) - 1)
                                        <button hx-click="move({{ $task['id'] }}, '{{ $statusKeys[$idx + 1] }}')"
                                                class="rounded px-1.5 py-0.5 text-sm text-slate-400 hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200" title="Move right">→</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="rounded-lg border border-dashed border-slate-300 px-3 py-6 text-center text-xs text-slate-400 dark:border-slate-700 dark:text-slate-500">
                            No tasks
                        </p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
