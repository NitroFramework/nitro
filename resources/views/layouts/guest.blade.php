<!DOCTYPE html>
<html lang="en">

@include('components.head', ['title' => $title ?? 'NitroPHP'])

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-brand-50 font-sans text-slate-900 antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <a href="/" class="mb-8 flex items-center justify-center gap-2 text-2xl font-extrabold tracking-tight">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-brand-600 text-xl text-white shadow-sm">⚡</span>
                Nitro<span class="text-brand-600">PHP</span>
            </a>

            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
