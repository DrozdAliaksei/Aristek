<?php

use Enum\RolesEnum;

return [
    [
        'url'   => '/users',
        'title' => 'Users',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER]
    ],
    [
        'url'   => '/rooms',
        'title' => 'Rooms',
        'roles' => [RolesEnum::ADMIN]
    ],
    [
        'url'   => '/equipments',
        'title' => 'Equipments',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER]
    ],
    [
        'url'   => '/installation_scheme',
        'title' => 'Installation schemes',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER,RolesEnum::VISITOR]
    ]
];