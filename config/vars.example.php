<?php

return [
    'join_code' => env('REGISTRATION_CODE'),
    'roles' => [
        'admin',
        'superadmin',
        'root',
    ],
    'admin_route_prefix' => 'portal.',
    'menu_sections' => [
        'conservation',
        'our-story',
        'traveler-resources',
        'more',
    ]
];
