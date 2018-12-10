<?php

return [
    \Controller\UsersController::class => [\Model\UserModel::class],
    \Controller\RoomsController::class => [\Model\RoomModel::class],
    \Model\UserModel::class => [\Core\DB\Connection::class],
    \Model\RoomModel::class => [\Core\DB\Connection::class],
    \Core\DB\Connection::class => ['%database%']
];