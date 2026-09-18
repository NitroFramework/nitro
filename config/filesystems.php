<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Disk
    |--------------------------------------------------------------------------
    */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disks
    |--------------------------------------------------------------------------
    | Each disk uses a driver: 'local' for this machine's filesystem, 's3' for
    | S3-compatible object storage. The 'public' disk is web-accessible via its
    | url; keep private files on 'local'.
    |
    | Deployed on a container platform, put anything that must outlive a deploy
    | on 's3' — the container's own filesystem does not survive one.
    */
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'visibility' => 'private',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'bucket' => env('AWS_BUCKET'),
            // Set for anything other than S3 itself — R2, Spaces, MinIO.
            'endpoint' => env('AWS_ENDPOINT') ?: null,
            // MinIO and some proxies address the bucket as a path segment
            // rather than a subdomain.
            'use_path_style_endpoint' => (bool) env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            // Public base URL, when the bucket has one. Without it, url()
            // returns the endpoint, which a private bucket will refuse; reach
            // for temporaryUrl() there instead.
            'url' => env('AWS_URL') ?: null,
            'visibility' => 'private',
        ],
    ],
];
