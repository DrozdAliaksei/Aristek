<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 21.11.18
 * Time: 18:28
 */

namespace Core;


class ServiceContainer
{
    /**
     * @var self
     */
    private static $instance;
    /**
     * @var array
     */
    private $config;
    private $services = [];

    /**
     * ServiceContainer constructor.
     */
    private function __construct(array $config)
    {

        $this->config = $config;
    }

    public static function getInstance(array $config = null):self
    {
        if(!isset(self::$instance)){
            self::$instance = new self($config);
        }
        elseif ($config != null){
            throw new \LogicException('serviceContainer has configured already');
        }
        return self::$instance;
    }

    public function get(string $key)
    {
        if (!array_key_exists($key, $this->services)){
            $this->services[$key] = $this->createService($key);
        }
        return $this->services[$key];
    }
    public function getParameter(string $key)
    {
        return $this->config['parameters'][$key];
    }
    private function createService(string $class)
    {
        if (!array_key_exists($class, $this->config['services'])){
            throw new \LogicException(sprintf('Service %s undefined', $class));
        }
        $parameters = [];
        foreach ($this->config['services'][$class] as $parameter) {
            if (substr($parameter, 0, 1) === '%' && substr($parameter, -1) === '%'){
                $parameters[] = $this->getParameter(substr($parameter,1,-1));
            }else {
                $parameters[] = $this->get($parameter);
            }
        }
        return new $class(...$parameters);
    }

}