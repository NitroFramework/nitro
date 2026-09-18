<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Session Driver
    |--------------------------------------------------------------------------
    |
    | Backend for the session Store. Supported: "native" (default — PHP's own
    | $_SESSION, interoperates with the CSRF layer and classic SAPIs),
    | "file" (cookie + file handler, worker-safe), "array" (in-memory, tests),
    | "redis" and "database".
    |
    | Deployed across more than one instance, choose "redis" or "database". A
    | file session lives on the instance that wrote it, so a second instance
    | does not see it and a redeploy throws every session away.
    |
    */
    'driver' => env('SESSION_DRIVER', 'native'),

    /*
    |--------------------------------------------------------------------------
    | Lifetime (minutes)
    |--------------------------------------------------------------------------
    */
    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    /*
    |--------------------------------------------------------------------------
    | Cookie Name
    |--------------------------------------------------------------------------
    */
    'cookie' => env('SESSION_COOKIE', 'nitro_session'),

    /*
    |--------------------------------------------------------------------------
    | File Store Location
    |--------------------------------------------------------------------------
    |
    | Where the "file" driver writes session payloads. Defaults (in the service
    | provider) to storage/framework/sessions when unset.
    |
    */
    'files' => env('SESSION_FILES', null),

    /*
    |--------------------------------------------------------------------------
    | Redis Store
    |--------------------------------------------------------------------------
    |
    | Which connection under database.redis the "redis" driver writes to, and
    | the prefix its keys carry. Null takes the default connection.
    |
    */
    'connection' => env('SESSION_CONNECTION') ?: null,
    'prefix' => env('SESSION_PREFIX', 'nitro:session:'),

    /*
    |--------------------------------------------------------------------------
    | Database Store
    |--------------------------------------------------------------------------
    |
    | The table the "database" driver reads and writes. See the
    | create_sessions_table migration for its shape.
    |
    */
    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Attributes (file/array drivers)
    |--------------------------------------------------------------------------
    |
    | Used when a non-native driver manages its own session cookie. `secure`
    | null means "auto" (only over HTTPS). The native driver uses PHP's own
    | session cookie settings and ignores these.
    |
    */
    'path' => env('SESSION_PATH', '/'),
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', null),
    'http_only' => true,
    'same_site' => env('SESSION_SAME_SITE', 'lax'),

];
