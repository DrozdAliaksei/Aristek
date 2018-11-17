<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:36
 */

namespace Core\Router;


class Route
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $controllerClass;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
    private $rules;

    /**
     * Route constructor.
     */
    public function __construct(string $path,string $controllerClass,string $method, array $rules=[])
    {

        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->method = $method;
        $this->rules = $rules;
    }

    /**
     * @return string
     */
    public function getControllerClass(): string
    {
        echo 'RouteGetController'.PHP_EOL;
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        echo 'RouteGetMethod'.PHP_EOL;
        return $this->method;
    }


    public function match(string $path):bool
    {
        echo 'RouteMatch'.PHP_EOL;
        return $this->path === $path;
    }
}