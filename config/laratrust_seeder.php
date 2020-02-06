<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'categories'=>'c,r,u,d',
            'roles'=>'c,r,u,d',
            'settings'=>'c,r,u,d',
            'movies'=>'c,r,u,d',
        ],
        'admin' => [
        ],
        'user' => [
        ],
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
