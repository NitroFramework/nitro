<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">
    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (stored ? stored === 'dark' : prefersDark) document.documentElement.classList.add('dark');
            } catch (e) {}
        })();
    </script>
    <title>{{ $title ?? 'Sign Up' }} — NitroPHP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-brand-50 font-sans text-slate-900 antialiased dark:from-slate-950 dark:via-slate-950 dark:to-brand-900/30 dark:text-slate-100">
    <div class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold text-slate-900 dark:text-slate-100">
                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-brand-600 text-white dark:bg-brand-500">⚡</span>
                    NitroPHP
                </a>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Create your account</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Takes less than a minute.</p>

                <form method="POST" action="/register" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-brand-400 dark:focus:ring-brand-400">
                        @if (errors('name'))<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ errors('name') }}</p>@endif
                    </div>

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-brand-400 dark:focus:ring-brand-400">
                        @if (errors('email'))<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ errors('email') }}</p>@endif
                    </div>

                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                        <input type="password" name="password" id="password" required minlength="8"
                               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-brand-400 dark:focus:ring-brand-400">
                        @if (errors('password'))<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ errors('password') }}</p>@endif
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Minimum 8 characters.</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-brand-400 dark:focus:ring-brand-400">
                    </div>

                    <button type="submit"
                            class="w-full rounded-md bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-500 dark:hover:bg-brand-400 dark:focus:ring-offset-slate-900">
                        Create account
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600 dark:text-slate-400">
                    Already registered?
                    <a href="/login" class="font-medium text-brand-600 hover:underline dark:text-brand-300">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
