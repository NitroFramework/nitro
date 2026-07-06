<!-- resources/views/components/layouts/app.blade.php -->
<!DOCTYPE html>
@php($nitroNav = config('htmx.navigation'))
<html lang="en" data-theme="light">

@include('components.head')

{{-- Additional styles pushed from child views --}}
@stack('styles')

<body>

    @include('components.sidebar')

    <main class="dashboard-main">

        @include('components.navbar')

        <div class="dashboard-main-body">

          


            <div id="main-content"
                 data-nitro-nav-root="{{ $nitroNav['select'] ?? '[data-nitro-nav-root]' }}"
                 data-nitro-nav-oob="{{ $nitroNav['select_oob'] ?? '#perf-badge' }}"
                 data-nitro-nav-cache="{{ ($nitroNav['cache'] ?? true) ? 'true' : 'false' }}"
                 data-nitro-nav-prefetch="{{ ($nitroNav['prefetch'] ?? true) ? 'true' : 'false' }}">
                <h1>COMPONENT/LAYOUT</h1>
                {{-- Page rendered in @elapsed_time seconds using @memory_usage MB of memory. --}}
                @include('components.breadcrumb', ['title' => $title ?? '', 'subTitle' => $subTitle ?? ''])


                

                {{-- Main content section --}}
                {{-- @yield('content') --}}
                {{ $content ?? '' }}

                {{  $slot ?? '' }}
            </div>

            <div class="footer-content">
                {{-- Footer content --}}
            </div>

        </div>

        @include('components.footer')

    </main>



    @include('components.script')

    {{-- Additional scripts pushed from child views --}}
    @stack('scripts')

    




    <script>
        /**
         * Generic HTMX Data Binding System for NitroPHP
         * 
         * Handles automatic DOM updates based on server response data.
         * 
         * How it works:
         * 1. Component methods call skipRender(['count' => 5])
         * 2. Server responds with HX-Response-Data header containing JSON
         * 3. This script listens for htmx:afterSwap event
         * 4. Finds elements with data-bind="fieldName" and updates them
         * 
         * Usage:
         * - Add data-component="componentName" to component wrapper
         * - Add data-bind="fieldName" to elements that should update
         * - Include this script in your layout
         */

        document.body.addEventListener('htmx:afterSwap', function(evt) {
            // Get the HX-Response-Data header containing JSON
            const responseData = evt.detail.xhr.getResponseHeader('HX-Response-Data');

            // If no response data, this was a normal full-render request
            if (!responseData) return;

            try {
                // Parse JSON response data
                const data = JSON.parse(responseData);

                // Find the component (element with data-component attribute)
                // This ensures updates only affect the specific component
                const component = evt.detail.target.closest('[data-component]');

                if (!component) return;

                // Update all elements with matching data-bind attributes
                // For example, data-bind="count" will be updated with data.count
                Object.entries(data).forEach(([key, value]) => {
                    const elements = component.querySelectorAll(`[data-bind="${key}"]`);

                    elements.forEach(elem => {
                        // Different handling for inputs vs display elements
                        if (elem.tagName === 'INPUT' || elem.tagName === 'TEXTAREA') {
                            elem.value = value;
                        } else {
                            elem.textContent = value;
                        }
                    });
                });
            } catch (error) {
                console.error('HTMX Data Binding Error: Failed to parse HX-Response-Data', error);
                console.error('Response data:', responseData);
            }
        });

        /**
         * Optional: Log HTMX requests for debugging
         * Uncomment to enable request logging
         */
        // document.body.addEventListener('htmx:beforeRequest', function(evt) {
        //     console.log('HTMX Request:', {
        //         method: evt.detail.verb,
        //         path: evt.detail.path,
        //         target: evt.detail.target.id,
        //     });
        // });

        /**
         * Optional: Log HTMX responses for debugging
         * Uncomment to enable response logging
         */
        // document.body.addEventListener('htmx:afterSwap', function(evt) {
        //     const responseData = evt.detail.xhr.getResponseHeader('HX-Response-Data');
        //     if (responseData) {
        //         console.log('HTMX Response Data:', JSON.parse(responseData));
        //     }
        // });
    </script>

</body>

</html>
