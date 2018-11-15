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
        $this->createConnection();
    }

    /**
     * @param $request
     * @return Response
     */
    public function createResponse(Request $request): Response
    {
        $route = $this->getRoute($request);
        $controller = $this->getController($route);

        return call_user_func([$controller, $route->getMethod()], $request);

    }

    /*public function getModel(): Model
    {
        return new UserModel($this->connection);

    }*/

    private function createConnection()
    {
        $config = $this->config['database'];
        $dsn = $this->getDSN($config);
        $pdo = new \PDO($dsn, $config['user'], $config['password']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection = new Connection($pdo);
    }

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
        }

        return $route;
    }

    private function getController(Route $route)
    {
        $class = $route->getControllerClass();
        $model = new \Model\UserModel($this->connection);
        return new $class($model);
    }

}   