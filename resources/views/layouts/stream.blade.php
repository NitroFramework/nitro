@stream
    <!DOCTYPE html>
    <html lang="en">

    @include('components.head', ['title' => $title ?? 'NitroPHP'])
    @stack('styles')

    <body class="min-h-screen bg-slate-50 font-sans text-slate-900" hx-ext="morph">

        @include('components.navbar', ['current_page' => $current_page ?? ''])

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @include('components.breadcrumb', [
                'title'    => $title ?? '',
                'subTitle' => $subTitle ?? '',
            ])

            <div id="main-content">
                @hole('content')
            </div>
        </main>

        @include('components.footer')

        @include('components.script')
        @stack('scripts')
    </body>
    </html>
@endstream
