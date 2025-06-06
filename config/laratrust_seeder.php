<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        /*'superadministrator' => 
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],*/
        'admin' => [
            'users' => 'c,r,u,d',
            'workorder'=>'c,r,u,d',
            //'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'dashboard' => 'r,u,d',
        ],
        'user' => [
            'profile' => 'r,u',
            'workorder'=>'c,r',
        ],
        
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
