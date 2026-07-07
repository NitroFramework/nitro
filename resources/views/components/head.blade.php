<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'NitroPHP' }}</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <link rel="stylesheet" href="/css/app.css">
    @if (config('nprogress.enabled'))
        <link rel="stylesheet" href="/css/vendor/nprogress.css">
    @endif

    <script defer src="/js/vendor/htmx.min.js"></script>
    <script defer src="/js/vendor/idiomorph-ext.min.js"></script>
    <script defer src="/js/vendor/alpine.min.js"></script>
    @if (config('nprogress.enabled'))
        <script defer src="/js/vendor/nprogress.js"></script>
    @endif

    @livewireStyles
</head>
