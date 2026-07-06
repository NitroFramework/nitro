<div id="notes-{{ $category }}" hx-component="notes"
     class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
    <h4 class="mb-3 text-sm font-semibold text-slate-700 dark:text-slate-200">📝 Notes — {{ ucfirst($category) }}</h4>

    <form hx-submit="add" class="mb-4 flex gap-2">
        <input type="text" name="text" placeholder="Add a note..."
               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-brand-400 dark:focus:ring-brand-400" />
        <button type="submit"
                class="rounded-md bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-400">
            Add
        </button>
    </form>

    @if (empty($notes))
        <p class="text-sm italic text-slate-400 dark:text-slate-500">No notes yet.</p>
    @else
        <ul class="divide-y divide-slate-100 dark:divide-slate-800">
            @foreach ($notes as $note)
                <li class="flex items-center justify-between py-2">
                    <span class="text-sm dark:text-slate-200">
                        <span class="mr-2 text-xs text-slate-500 dark:text-slate-400">{{ $note['timestamp'] }}</span>
                        {{ $note['text'] }}
                    </span>
                    <button hx-click="remove({{ $note['id'] }})"
                            class="rounded px-2 py-1 text-red-500 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">✕</button>
                </li>
            @endforeach
        </ul>
    @endif

    @if (!empty($notes))
        <div class="mt-3 text-right">
            <button hx-click="clear" hx-confirm="Clear all notes?"
                    class="rounded-md border border-slate-300 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-200 dark:hover:bg-slate-800">
                Clear all
            </button>
        </div>
    @endif
</div>
