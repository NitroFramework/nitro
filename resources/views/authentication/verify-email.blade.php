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
    <title>{{ $title ?? 'Verify Email' }} — NitroPHP</title>
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
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Verify your email</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Thanks for signing up! Please click the link in the email we just sent to verify your
                    address. (In local dev the link is written to <code>storage/logs/mail.log</code>.)
                </p>

                @if ($status === 'verification-link-sent')
                    <div class="mt-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-300">
                        A fresh verification link has been sent.
                    </div>
                @endif

                <div class="mt-6 flex items-center justify-between gap-3">
                    <form method="POST" action="/email/verification-notification">
                        @csrf
                        <button type="submit"
                                class="rounded-md bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-500 dark:hover:bg-brand-400 dark:focus:ring-offset-slate-900">
                            Resend verification email
                        </button>
                    </form>

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-600 hover:underline dark:text-slate-400">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
