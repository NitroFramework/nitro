<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Channel
    |--------------------------------------------------------------------------
    |
    | The channel used when none is named. It must be one of the channels
    | listed below — a name that is not configured raises rather than falling
    | back, so a channel injected by a platform fails loudly instead of
    | writing somewhere nobody reads.
    |
    */
    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Channels
    |--------------------------------------------------------------------------
    |
    | Each channel names a driver and its options. Available drivers:
    | single, daily, stream, errorlog, null, and stack.
    |
    */
    'channels' => [

        // A file and the process's own output. A container platform collects
        // the latter; a file inside a container goes away with the container.
        'stack' => [
            'driver'            => 'stack',
            'channels'          => ['single', 'stderr'],
            'ignore_exceptions' => true,
        ],

        // One file, moved aside once it reaches max_bytes.
        'single' => [
            'driver'    => 'single',
            'path'      => env('LOG_PATH') ?: null,
            'max_bytes' => (int) env('LOG_MAX_BYTES', 5242880),
            'level'     => env('LOG_LEVEL', 'debug'),
        ],

        // One file per day, keeping the last fortnight.
        'daily' => [
            'driver' => 'daily',
            'path'   => env('LOG_PATH') ?: null,
            'days'   => (int) env('LOG_DAILY_DAYS', 14),
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        'stderr' => [
            'driver' => 'stream',
            'stream' => 'php://stderr',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        'stdout' => [
            'driver' => 'stream',
            'stream' => 'php://stdout',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        // Hands the line to PHP's error_log(); where it lands is the SAPI's
        // business, which suits a host that already collects PHP's output.
        'errorlog' => [
            'driver' => 'errorlog',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        // Silences logging without removing the calls that write to it.
        'null' => [
            'driver' => 'null',
        ],

    ],

];
