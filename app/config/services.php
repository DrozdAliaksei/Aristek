<?php

return [
    \Controller\SecurityController::class => [\Service\SecurityService::class,\Core\HTTP\SessionProvider::class],
    \Controller\UsersController::class => [\Model\UserModel::class,\Core\HTTP\SessionProvider::class],
    \Controller\RoomsController::class => [\Model\RoomModel::class],
    \Controller\EquipmentsController::class => [\Model\EquipmentModel::class],
    \Controller\InstallationSchemeController::class => [
        \Model\InstallationSchemeModel::class,
        \Model\RoomModel::class,
        \Model\EquipmentModel::class,
        \Core\HTTP\SessionProvider::class
    ],
    \Core\DB\Connection::class => ['%database%'],
    \Core\Security\Guardian::class => [\Middleware\GuestMiddleware::class,\Middleware\RoleMiddleware::class],
    \Middleware\GuestMiddleware::class => [\Service\SecurityService::class],
    \Middleware\RoleMiddleware::class => ['%security%', \Service\SecurityService::class],
    \Model\UserModel::class => [
        \Core\DB\Connection::class,
        \Core\Security\PasswordHelper::class,
        \Core\Security\StringBuilder::class,
    ],
    \Model\RoomModel::class => [\Core\DB\Connection::class],
    \Model\EquipmentModel::class => [\Core\DB\Connection::class],
    \Model\InstallationSchemeModel::class => [\Core\DB\Connection::class],
    \Service\SecurityService::class => [
        \Core\HTTP\SessionProvider::class,
        \Model\UserModel::class,
        \Core\Security\PasswordHelper::class,
    ],
];