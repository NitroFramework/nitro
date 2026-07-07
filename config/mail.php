<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    | 'log' writes to storage/logs/mail.log (great for local dev), 'array' keeps
    | messages in memory (tests), 'smtp' delivers over SMTP.
    */
    'default' => env('MAIL_MAILER', 'log'),

    'mailers' => [
        'log' => [
            'transport' => 'log',
            'path' => storage_path('logs/mail.log'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => (int) env('MAIL_PORT', 1025),
            'username' => env('MAIL_USERNAME') ?: null,
            'password' => env('MAIL_PASSWORD') ?: null,
            'encryption' => env('MAIL_ENCRYPTION') ?: null,
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'NitroPHP'),
    ],
];
