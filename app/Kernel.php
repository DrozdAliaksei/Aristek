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
use Core\Security\Guardian;

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

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        $this->config = require __DIR__.'/config/config.php';
        $this->container = \Core\ServiceContainer::getInstance($this->config);
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @param $request
     *
     * @return Response
     */
    public function createResponse(Request $request): Response
    {
        $route = $this->getRoute($request);
        /** @var Guardian $guardian */
        $guardian = $this->container->get(Guardian::class);
        if ($response = $guardian->handle($route, $request)) {
            return $response;
        }
        $controller = $this->getController($route);
        $params = $route->getPathValues($request->getPath());
        $request->setAttributes($params);

        return call_user_func([$controller, $route->getMethod()], $request);
    }

    /**
     * @param Request $request
     *
     * @return Route|null
     */
    private function getRoute(Request $request): Route
    {
        require_once __DIR__.'/config/routes.php';
        $route = Router::findRoute($request);
        if ($route === null) {
            throw new Exception("Route not found");
        }

        return $route;
    }

    /**
     * @param Route $route
     *
     * @return mixed
     */
    private function getController(Route $route)
    {
        return $this->container->get($route->getControllerClass());
    }
}