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
    /**
     * @var Route[]
     */
    private static $routes = [];

    /**
     * @param Request $request
     * @return null|Route
     */
    public static function findRoute(Request $request)
    {
        foreach (self::$routes as $route) {
            if ($route->match($request->getPath())) {
                #echo 'findRoute'.PHP_EOL;
                return $route;
            }
        }
        #echo 'Router_dont_find_route'.PHP_EOL;
        return null;
    }


    public static function add(string $pattern, string $controllerClass, string $method, array $rules = [])
    {
        self::$routes[] = new Route($pattern, $controllerClass, $method, $rules);
    }


}