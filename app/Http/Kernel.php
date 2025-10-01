<?php  

protected $middlewareGroups = [
    'web' => [
        // ...
        \RealRashid\SweetAlert\ToSweetAlert::class,
    ],
    'auth' => [\App\Http\Middleware\Authenticate::class,],
    // ...
];
