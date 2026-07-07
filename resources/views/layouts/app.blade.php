<!DOCTYPE html>
<html lang="en">

@include('components.head', ['title' => $title ?? 'NitroPHP'])
@stack('styles')

<body class="min-h-screen bg-slate-50 font-sans text-slate-900" hx-ext="morph">
    <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/70 backdrop-blur-md">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-6">
            <a href="/" class="flex items-center gap-2 text-lg font-extrabold tracking-tight">
                <span class="text-xl">⚡</span> Nitro<span class="text-brand-600">PHP</span>
            </a>

            <div class="flex items-center gap-2 text-sm font-semibold">
                @auth
                    <span class="mr-1 hidden text-slate-500 sm:inline">{{ auth()->user()?->name ?? 'Account' }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="rounded-lg px-4 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="/login"
                        class="rounded-lg px-4 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                        Log in
                    </a>
                    <a href="/register"
                        class="rounded-lg bg-brand-600 px-4 py-2 text-white shadow-sm transition hover:bg-brand-700">
                        Register
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">
        @yield('content')
    </main>

    @stack('scripts')
    @htmxScripts
    @livewireScripts
</body>

</html>
