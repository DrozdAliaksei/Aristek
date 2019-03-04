<?php

use Enum\RolesEnum;

return [
    [
        'url'   => '/users',
        'title' => 'Users',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER],
    ],
    [
        'url'   => '/rooms',
        'title' => 'Rooms',
        'roles' => [RolesEnum::ADMIN],
    ],
    [
        'url'   => '/equipments',
        'title' => 'Equipments',
        'roles' => [RolesEnum::ADMIN],
    ],
    [
        'url'   => '/installation-scheme',
        'title' => 'Installation schemes',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER, RolesEnum::VISITOR],
    ],
    [
        'url'   => '/profile',
        'title' => 'Profile',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER,RolesEnum::VISITOR],
    ],
    [
        'url'   => '/logout',
        'title' => 'Logout',
        'roles' => [RolesEnum::ADMIN, RolesEnum::USER, RolesEnum::VISITOR],
    ],
];