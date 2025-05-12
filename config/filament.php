<?php


return [
    'auth' => [
        'guard' => 'web',
        'user' => \App\Models\User::class,
    ],

    'pages' => [
        'dashboard' => \Filament\Pages\Dashboard::class,
    ],

    'logo' => env('APP_LOGO', public_path('images/logo-bima-laundry-hitam.png')),  
    'title' => env('APP_NAME', 'Dashboard Company Profile Bima Laundry'),
];

