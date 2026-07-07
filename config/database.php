<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection
    |--------------------------------------------------------------------------
    */
    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    */
    'connections' => [
        // Zero-config default — a single file, no server. `nitro migrate`
        // creates the file if it doesn't exist yet.
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', base_path('database/database.sqlite')),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'nitro'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'options' => [
                PDO::ATTR_PERSISTENT => false,
            ],
        ],

        // Read/Write separation example
        'read' => [
            'driver' => 'mysql',
            'host' => env('DB_READ_HOST', 'read.localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'nitro'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],

        'write' => [
            'driver' => 'mysql',
            'host' => env('DB_WRITE_HOST', 'write.localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'nitro'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Query Logging
    |--------------------------------------------------------------------------
    */
    'log_queries' => env('DB_LOG_QUERIES', false),

    /*
    |--------------------------------------------------------------------------
    | Slow Query Threshold (milliseconds)
    |--------------------------------------------------------------------------
    */
    'slow_query_threshold' => 1000,
];