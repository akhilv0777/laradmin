<?php

return [
    'super_admin' => [
        'name' => env('LARADMIN_SUPER_NAME', 'Super Admin'),
        'email' => env('LARADMIN_SUPER_EMAIL', 'admin@example.com'),
        'password' => env('LARADMIN_SUPER_PASSWORD', 'password'),
        'force_password_change' => true,
    ],
    'default_roles' => ['user','manager','editor','admin'],
    'route' => [
        'admin_prefix' => 'admin',
        'admin_middleware' => ['web','auth','role:super_admin','must.change.password'],
        'auth_middleware' => ['web','guest'],
    ],
];
