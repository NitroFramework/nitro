<div id="students-wrapper" hx-component="studentTable" class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    @foreach (['Enrollment #', 'Name', 'Email', 'Gender', 'City', 'Country', 'GPA', 'Status', 'Enrolled', 'Actions'] as $h)
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @loop($students)
                    <tr class="hover:bg-slate-50">
                        <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-slate-700">{{ $student->enrollment_number }}</td>
                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-900">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->email }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->gender }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->city }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->country }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->gpa }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->status }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $student->enrollment_date }}</td>
                        <td class="whitespace-nowrap px-4 py-3">
                            <button hx-click="delete({{ $student->id }})" hx-confirm="Delete this student?"
                                    class="rounded-md bg-red-50 px-3 py-1 text-xs font-medium text-red-700 hover:bg-red-100">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endloop
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 bg-slate-50 px-4 py-3">
        @include('components.pagination-info', ['paginator' => $students])

        @php
            $cur   = $students->currentPage();
            $last  = $students->lastPage();
            $start = max(1, $cur - 2);
            $end   = min($last, $cur + 2);
            $pLink     = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700';
            $pDisabled = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm font-medium text-slate-400';
            $pCurrent  = 'inline-flex min-w-[2.25rem] items-center justify-center rounded-md bg-brand-600 px-3 py-1.5 text-sm font-semibold text-white';
        @endphp

        {{-- Component pagination: hx-click drives the component's goToPage()
             action and re-renders in place (no URL navigation). --}}
        <nav class="flex flex-wrap items-center gap-2">
            @if ($cur > 1)
                <button hx-click="goToPage(1)" class="{{ $pLink }}">First</button>
                <button hx-click="goToPage({{ $cur - 1 }})" class="{{ $pLink }}">Previous</button>
            @else
                <span class="{{ $pDisabled }}">First</span>
                <span class="{{ $pDisabled }}">Previous</span>
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i === $cur)
                    <span class="{{ $pCurrent }}">{{ $i }}</span>
                @else
                    <button hx-click="goToPage({{ $i }})" class="{{ $pLink }}">{{ $i }}</button>
                @endif
            @endfor

            @if ($cur < $last)
                <button hx-click="goToPage({{ $cur + 1 }})" class="{{ $pLink }}">Next</button>
                <button hx-click="goToPage({{ $last }})" class="{{ $pLink }}">Last</button>
            @else
                <span class="{{ $pDisabled }}">Next</span>
                <span class="{{ $pDisabled }}">Last</span>
            @endif
        </nav>
    </div>
</div>
