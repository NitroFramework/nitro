@if (isset($errors) && count($errors))
    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 dark:border-red-500/30 dark:bg-red-500/10">
        <h3 class="text-sm font-semibold text-red-800 dark:text-red-300">Please fix the following:</h3>
        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-200">
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
