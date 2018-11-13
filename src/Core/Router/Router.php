<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:36
 */

namespace Core\Router;

use Core\Request\Request;

class Router
{
    private static $routes = [];

    /**
     * @param Request $request
     * @return null|Route
     */
    public static function findRoute(Request $request)
    {

    }


    public static function add(string $string, string $controllerClass, string $method, array $rules = [])
    {
    }
}