<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 21.11.18
 * Time: 17:36
 */

namespace Enum;

final class RolesEnum
{
    const ADMIN = 'admin';
    const VISITOR = 'visitor';
    const USER = 'user';

    public static function getAll(): array
    {
        return [self::ADMIN, self::VISITOR, self::USER];
    }
}
