<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 17:10
 */

use Enum\RolesEnum;

return [
    '^/users' => [RolesEnum::ADMIN, RolesEnum::USER],
    '^/rooms' => [RolesEnum::ADMIN],
    '^/equipments' => [RolesEnum::ADMIN, RolesEnum::USER],
    '^/installation_scheme' => [RolesEnum::ADMIN, RolesEnum::USER, RolesEnum::VISITOR],
    '^/logout$' => [RolesEnum::ADMIN, RolesEnum::USER, RolesEnum::VISITOR],
];