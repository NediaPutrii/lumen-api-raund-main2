<?php

return[
    // 'defaults' => [
    //     'guard' => 'api',
    //     'password' => 'users',
    // ],

    // 'guards' => [
    //     'api' => [
    //         'driver' => 'jwt',
    //         'provider' => 'users',
    //     ],
        
    // ],

    // 'provider' => [
    //     'users' => [
    //         'driver' => 'eloquent',
    //         'model' => \App\Models\User::class
    //     ]
    // ]

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),
        'passwords' => 'users',
    ],
    
    'guards' => [
         'api' => [
           'driver' => 'jwt',
           'provider' => 'users'
         ],
    ],
    
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  =>  \App\Models\User::class,
        ]
    ],
];

