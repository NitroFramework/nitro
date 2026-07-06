<!DOCTYPE html>
<html lang="en">

@include('components.head', ['title' => $title ?? 'NitroPHP'])
@stack('styles')

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 dark:bg-slate-950 dark:text-slate-100" hx-ext="morph">
    @php($nitroNav = config('htmx.navigation'))

    @include('components.navbar', ['current_page' => $current_page ?? ''])

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('components.breadcrumb', [
            'title' => $title ?? '',
            'subTitle' => $subTitle ?? '',
        ])

        <div id="main-content" data-nitro-nav-root="{{ $nitroNav['select'] ?? '[data-nitro-nav-root]' }}"
            data-nitro-nav-oob="{{ $nitroNav['select_oob'] ?? '#perf-badge' }}">
            @yield('content')
            @stack('teleported_modals')
        </div>
    </main>

    @include('components.footer')

    @include('components.perf-badge')

    @include('components.script')
    @stack('scripts')

    @livewireScripts
</body>

</html>
