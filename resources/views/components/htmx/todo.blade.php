<div hx-component="todo" id="todo-app" class="mx-auto max-w-xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
    <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">Todo list</h2>

    <div class="mt-3 flex gap-4 text-sm text-slate-600 dark:text-slate-400">
        <span>Total: <strong class="text-slate-900 dark:text-slate-100">{{ $total ?? 0 }}</strong></span>
        <span>Completed: <strong class="text-slate-900 dark:text-slate-100">{{ $completed ?? 0 }}</strong></span>
        <span>Pending: <strong class="text-slate-900 dark:text-slate-100">{{ $pending ?? 0 }}</strong></span>
    </div>

    <form hx-submit="add" class="mt-4 flex gap-2">
        <input name="text" id="todo-input" placeholder="Add a new todo..."
               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-brand-400 dark:focus:ring-brand-400" />
        <button type="submit" class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">Add</button>
    </form>

    @if (empty($todos))
        <div class="mt-4 rounded-md border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">
            No todos yet. Add one above!
        </div>
    @else
        <ul class="mt-4 divide-y divide-slate-100 dark:divide-slate-800">
            @foreach ($todos as $todo)
                <li class="flex items-center gap-3 py-3">
                    <button hx-click="toggle({{ $todo['id'] }})"
                            class="h-5 w-5 shrink-0 rounded border-2 {{ $todo['completed'] ? 'border-brand-600 bg-brand-600 dark:border-brand-500 dark:bg-brand-500' : 'border-slate-300 dark:border-slate-600' }}">
                        @if ($todo['completed'])
                            <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </button>
                    <span class="flex-1 text-sm {{ $todo['completed'] ? 'text-slate-400 line-through dark:text-slate-500' : 'text-slate-900 dark:text-slate-100' }}">{{ $todo['text'] }}</span>
                    <button hx-click="delete({{ $todo['id'] }})" hx-confirm="Are you sure?"
                            class="text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400">✕</button>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4 dark:border-slate-800">
        <button hx-click="clearCompleted" class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Clear completed</button>
        <button hx-click="reset" class="rounded-md bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500/20">Reset</button>
    </div>
</div>

<div class="mx-auto mt-10 max-w-xl space-y-4">
    <x-alert>This is a default info alert</x-alert>
    <x-alert type="danger">Something went wrong</x-alert>
    <x-alert type="success">
        <x-slot:title>Well done!</x-slot:title>
        Your profile has been updated.
    </x-alert>
</div>

<div class="mx-auto mt-10 max-w-xl space-y-4">
    <x-card color="#f1f5f9" title="Card Title">
        This is the card body content.
    </x-card>

    <x-card color="#ecfeff">
        <x-slot:header>Custom Header</x-slot:header>
        This card has a custom header and no title.
        <x-slot:footer>Custom Footer</x-slot:footer>
    </x-card>
</div>
