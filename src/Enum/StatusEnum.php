<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 14.12.18
 * Time: 13:34
 */

namespace Enum;

final class StatusEnum
{
    const On = ['On', 1];
    const Off = ['Off', 0];

    public static function getAll(): array
    {
        return [self::On, self::Off];
    }
}