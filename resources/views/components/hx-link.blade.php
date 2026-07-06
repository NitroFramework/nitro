@php($nitroNav = config('htmx.navigation'))

@props([
    'href'      => '#',
    'target'    => $nitroNav['target'] ?? '[data-nitro-nav-root]',
    'swap'      => 'innerHTML',
    'select'    => $nitroNav['select'] ?? '[data-nitro-nav-root]',
    'selectOob' => $nitroNav['select_oob'] ?? '#perf-badge',
    'push'      => 'true',
    'instant'   => true,
    'cache'     => $nitroNav['cache'] ?? true,
    'prefetch'  => $nitroNav['prefetch'] ?? true,
])

{{-- HTMX-driven anchor — behaves like a regular <a> but does an AJAX GET via
     HTMX and swaps the result into the target. selectOob lets out-of-band
     elements (perf badge, etc.) get refreshed from the same response. --}}
<a href="{{ $href }}"
   hx-get="{{ $href }}"
   hx-target="{{ $target }}"
   hx-swap="{{ $swap }}"
   hx-select="{{ $select }}"
   hx-select-oob="{{ $selectOob }}"
   hx-push-url="{{ $push }}"
   data-nitro-nav="{{ $instant ? 'true' : 'false' }}"
   data-nitro-nav-target="{{ $target }}"
   data-nitro-nav-select="{{ $select }}"
   data-nitro-nav-select-oob="{{ $selectOob }}"
   data-nitro-nav-push="{{ $push }}"
   data-nitro-nav-cache="{{ $cache ? 'true' : 'false' }}"
   data-nitro-nav-prefetch="{{ $prefetch ? 'true' : 'false' }}"
   {{ $attributes }}>{{ $slot }}</a>
