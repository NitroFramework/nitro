<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Channel
    |--------------------------------------------------------------------------
    |
    | Where log lines go. "file" writes to storage/logs; "stderr" and "stdout"
    | write to the process's own streams.
    |
    | On a container platform choose a stream: the platform collects what the
    | process writes, and a file inside the container is thrown away when the
    | container is replaced.
    |
    */
    'channel' => env('LOG_CHANNEL', 'file'),

    /*
    |--------------------------------------------------------------------------
    | File Location
    |--------------------------------------------------------------------------
    |
    | Overrides the default path when the channel is "file". Null uses
    | storage/logs/nitro.log.
    |
    */
    'path' => env('LOG_PATH') ?: null,

    /*
    |--------------------------------------------------------------------------
    | Rotation
    |--------------------------------------------------------------------------
    |
    | Move the log aside once it reaches this many bytes, so it cannot grow
    | without bound. 0 disables rotation; a stream channel ignores it.
    |
    */
    'max_bytes' => (int) env('LOG_MAX_BYTES', 5242880),

];
