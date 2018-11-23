<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.55
 */

use Core\DB\Connection;
use Core\Request\Request;
use Core\Response\Response;
use Core\Router\Route;
use Core\Router\Router;

class Kernel
{
    /**
     * @var array
     */
    private $config;
    /**
     * @var Connection
     */
    private $connection;

    public function __construct()
    {
        $this->config = require __DIR__.'/config/config.php';
        $this->container = \Core\ServiceContainer::getInstance($this->config);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param $request
     * @return Response
     */
    public function createResponse(Request $request): Response
    {
        $route = $this->getRoute($request);
        $controller = $this->getController($route);
        $params = $route->getPathValues();
        array_unshift($params,$request);
        return call_user_func_array([$controller, $route->getMethod()], $params);

    }

    /*public function getModel(): Model
    {
        return new UserModel($this->connection);

    }*/

    /**
     * @param $host
     * @param $db
     * @return string
     */
    private function getDSN(array $config): string
    {
        return sprintf("mysql:host=%s;dbname=%s", $config['host'], $config['database']);
    }

    /**
     * @param Request $request
     * @return Route|null
     */
    private function getRoute(Request $request): Route
    {
        require_once __DIR__.'/config/routes.php';
        $route = Router::findRoute($request);
        if ($route === null) {
            //TODO throw exception 404
            echo 'Kernel_dont_found_route => ERROR '.PHP_EOL;
        }
        return $route;
    }

    private function getController(Route $route)
    {
        return $this->container->get($route->getControllerClass());
    }

}   