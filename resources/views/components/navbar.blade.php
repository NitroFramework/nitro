@php
    $current = $current_page ?? '';
    $activeClass   = 'bg-brand-50 text-brand-700 dark:bg-brand-500/15 dark:text-brand-200';
    $inactiveClass = 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-100';
@endphp

<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/80 backdrop-blur dark:border-slate-800 dark:bg-slate-950/75"
        x-data="{ open: false }"
        data-nav>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <x-hx-link href="/" class="flex items-center gap-2 font-bold text-slate-900 dark:text-slate-100">
            <span class="grid h-8 w-8 place-items-center rounded-lg bg-brand-600 text-white shadow-sm shadow-brand-500/30 dark:bg-brand-500 dark:shadow-brand-400/20">⚡</span>
            <span>NitroPHP</span>
        </x-hx-link>

        <nav class="hidden md:flex">
            <ul class="flex items-center gap-1">
                <li>
                    <x-hx-link href="/components" data-nav-link="/components"
                               class="rounded-md px-3 py-2 text-sm font-medium transition {{ $current === 'components' ? $activeClass : $inactiveClass }}">Components</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/students" data-nav-link="/students"
                               class="rounded-md px-3 py-2 text-sm font-medium transition {{ $current === 'students' ? $activeClass : $inactiveClass }}">Students</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/users" data-nav-link="/users"
                               class="rounded-md px-3 py-2 text-sm font-medium transition {{ $current === 'users' ? $activeClass : $inactiveClass }}">Users</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/blade-showcase" data-nav-link="/blade-showcase"
                               class="rounded-md px-3 py-2 text-sm font-medium transition {{ $current === 'blade-showcase' ? $activeClass : $inactiveClass }}">Blade demo</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/docs" data-nav-link="/docs"
                               class="rounded-md px-3 py-2 text-sm font-medium transition {{ $current === 'docs' ? $activeClass : $inactiveClass }}">Docs</x-hx-link>
                </li>
                {{-- Livewire pages: plain links (full load) so livewire.js initializes; not HTMX-boosted. --}}
                <li>
                    <a wire:navigate.keydown href="/livewire-demo" data-nav-link="/livewire-demo"
                       class="rounded-md px-3 py-2 text-sm font-medium transition {{ ($current ?? '') === 'livewire-demo' ? $activeClass : $inactiveClass }}">Livewire</a>
                </li>
                <li>
                    <a wire:navigate.keydown href="/lw/students" data-nav-link="/lw/students"
                       class="rounded-md px-3 py-2 text-sm font-medium transition {{ ($current ?? '') === 'lw-students' ? $activeClass : $inactiveClass }}">Students LW</a>
                </li>
            </ul>
        </nav>

        <div class="flex items-center gap-2">
            {{-- Theme toggle --}}
            <button type="button"
                    x-data="themeToggle()"
                    @click="toggle()"
                    :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                    :title="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                    class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800/70">
                <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                </svg>
                <svg x-show="dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                </svg>
            </button>

            @if (function_exists('auth') && auth()->check())
                <span class="hidden text-sm text-slate-500 dark:text-slate-400 sm:inline">{{ auth()->user()->name ?? auth()->user()->email ?? 'User' }}</span>
                <form method="post" action="/logout" class="inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit"
                            class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                        Log out
                    </button>
                </form>
            @else
                <x-hx-link href="/login"
                           class="rounded-md px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800/70">Log in</x-hx-link>
                <x-hx-link href="/register"
                           class="rounded-md bg-brand-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">Sign up</x-hx-link>
            @endif

            <button @click="open = !open"
                    class="ml-1 inline-flex items-center justify-center rounded-md p-2 text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800/70 md:hidden"
                    aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950 md:hidden">
        <nav class="px-4 py-3">
            <ul class="space-y-1">
                <li>
                    <x-hx-link href="/components" data-nav-link="/components" @click="open = false"
                               class="block rounded-md px-3 py-2 text-sm font-medium {{ $current === 'components' ? $activeClass : $inactiveClass }}">Components</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/students" data-nav-link="/students" @click="open = false"
                               class="block rounded-md px-3 py-2 text-sm font-medium {{ $current === 'students' ? $activeClass : $inactiveClass }}">Students</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/users" data-nav-link="/users" @click="open = false"
                               class="block rounded-md px-3 py-2 text-sm font-medium {{ $current === 'users' ? $activeClass : $inactiveClass }}">Users</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/blade-showcase" data-nav-link="/blade-showcase" @click="open = false"
                               class="block rounded-md px-3 py-2 text-sm font-medium {{ $current === 'blade-showcase' ? $activeClass : $inactiveClass }}">Blade demo</x-hx-link>
                </li>
                <li>
                    <x-hx-link href="/docs" data-nav-link="/docs" @click="open = false"
                               class="block rounded-md px-3 py-2 text-sm font-medium {{ $current === 'docs' ? $activeClass : $inactiveClass }}">Docs</x-hx-link>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    function themeToggle() {
        return {
            dark: document.documentElement.classList.contains('dark'),
            toggle() {
                this.dark = !this.dark;
                document.documentElement.classList.toggle('dark', this.dark);
                try { localStorage.setItem('theme', this.dark ? 'dark' : 'light'); } catch (e) {}
            },
        };
    }
</script>
