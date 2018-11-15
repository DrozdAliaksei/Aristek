<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 20:02
 */

namespace Core\Request;

class RequestFactory
{

    public static function createRequest(): Request
    {
        $request = new Request(
            self::getPath(), self::getRequest()
        );

        return $request;
    }

    private static function getPath() :string
    {
            return $_SERVER['PATH_INFO'];
    }

    private static function getRequest(): array
    {
        return $_REQUEST;
    }
}