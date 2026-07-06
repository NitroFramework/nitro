<div id="datatable-app" hx-component="dataTable" hx-target="#datatable-app" hx-swap="morph:outerHTML"
     class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="px-7 pt-6">
        <h2 class="mb-4 text-xl font-bold text-slate-900">Students</h2>

        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <input id="dt-search" name="search" value="{{ $search ?? '' }}" placeholder="Search..."
                   autocomplete="off" hx-model="search" hx-debounce="300" autofocus
                   class="block w-full min-w-[200px] flex-1 rounded-md border border-slate-300 bg-white px-3.5 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500" />

            <select hx-model.lazy="perPage"
                    class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500">
                <option value="10" @selected(($perPage ?? 10) == 10)>10 per page</option>
                <option value="25" @selected(($perPage ?? 10) == 25)>25 per page</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        @if (empty($rows))
            <div class="py-10 text-center text-sm text-slate-400">No students found matching your search.</div>
        @else
            @php
                $cols = [
                    'id' => '#', 'name' => 'Name', 'email' => 'Email',
                    'age' => 'Age', 'grade' => 'Grade', 'status' => 'Status',
                ];
                $currentSort = $sort ?? 'id';
                $currentDir  = $direction ?? 'asc';
                $arrow = $currentDir === 'asc' ? '↑' : '↓';
            @endphp

            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        @foreach ($cols as $col => $label)
                            @php $isSorted = $currentSort === $col; @endphp
                            <th hx-click="sort('{{ $col }}')"
                                class="cursor-pointer select-none whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 hover:bg-slate-100">
                                {{ $label }}{!! $isSorted ? ' <span class="text-brand-600">' . $arrow . '</span>' : '' !!}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($rows as $student)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-4 py-3 text-slate-500">{{ $student['id'] }}</td>
                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-900">{{ $student['name'] }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student['email'] }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student['age'] }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">
                                    {{ $student['grade'] }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <x-badge :type="$student['status']" :label="ucfirst($student['status'])" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 bg-slate-50 px-7 py-4">
        <div class="text-xs text-slate-500">
            @if (($total ?? 0) > 0)
                Showing {{ $from }} to {{ $to }} of {{ $total }} students
            @else
                No results
            @endif
        </div>

        @php
            $totalPages = $totalPages ?? 1;
            $currentPage = $page ?? 1;
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $startPage + 4);
            $btnBase = 'rounded-md border border-slate-200 bg-white px-3 py-1 text-sm hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700 disabled:opacity-40 disabled:hover:bg-white disabled:hover:text-slate-700';
        @endphp

        <div class="flex gap-1.5">
            <button hx-click="goToPage({{ max(1, $currentPage - 1) }})" {{ $currentPage <= 1 ? 'disabled' : '' }}
                    class="{{ $btnBase }}">← Prev</button>

            @for ($p = $startPage; $p <= $endPage; $p++)
                <button hx-click="goToPage({{ $p }})"
                        class="{{ $p === $currentPage
                            ? 'rounded-md bg-brand-600 px-3 py-1 text-sm font-semibold text-white'
                            : $btnBase }}">
                    {{ $p }}
                </button>
            @endfor

            <button hx-click="goToPage({{ min($totalPages, $currentPage + 1) }})" {{ $currentPage >= $totalPages ? 'disabled' : '' }}
                    class="{{ $btnBase }}">Next →</button>
        </div>
    </div>
</div>
