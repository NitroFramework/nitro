<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Component Namespace
    |---------------------------------------------------------------------------
    |
    | The root namespace #[Client] components resolve from by convention, so a
    | short name like @fusion('Counter') (or Route::fusion('/x', 'Counter'))
    | maps to App\Fusion\Components\Counter. Their co-located Blade view lives
    | next to the class (Counter.php → Counter.blade.php).
    |
    */

    'namespace' => 'App\\Fusion\\Components',

    /*
    |---------------------------------------------------------------------------
    | Page Layout
    |---------------------------------------------------------------------------
    |
    | The layout a Route::fusion() page renders into when it is not given its own
    | view. The component's HTML fills $layout_section, so a Fusion page shares
    | the app's chrome just like a routed Livewire component.
    |
    */

    'layout' => 'layouts.app',
    'layout_section' => 'content',

    /*
    |---------------------------------------------------------------------------
    | Server Endpoint
    |---------------------------------------------------------------------------
    |
    | The route the client runtime posts #[Server] method calls to. The value is
    | used both to register the endpoint and (injected via @fusionScripts) to
    | tell the runtime where to send them, so changing it here is enough.
    |
    */

    'call_uri' => '/nitro/fusion/call',

];
