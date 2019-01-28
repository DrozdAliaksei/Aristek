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
            self::getPath(),self::getMethod(), self::getRequest()
        );

        return $request;
    }

    private static function getPath() :string
    {
        #echo $_SERVER['PATH_INFO'].PHP_EOL;
            //return $_SERVER['PATH_INFO'];
        return $_SERVER['REQUEST_URI'];
    }

    private static function getRequest(): array
    {
        return $_REQUEST;
    }

    private static function getMethod():string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}