<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 16:56
 */

namespace Core\HTTP;

final class Session
{
    /**
     * @var self
     */
    private static  $instance;

    /**
     * Session constructor.
     */
    private function __construct()
    {

    }


    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
            self::$instance->start();
        }
        return self::$instance;
    }

    private function start()
    {
        if(!$this->hasStarted()){
            if(!session_start()){
                throw new \Exception('Session can not be started!');
            }
        }
    }

    private function hasStarted()
    {
        return php_sapi_name()!== 'cli' && session_status() === PHP_SESSION_ACTIVE;
    }

    public function set(string $key, $value)
    {
        $this->checkSessionStarted();
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        $this->checkSessionStarted();
        return$_SESSION[$key];
    }

    public function has(string $key) :bool
    {
        $this->checkSessionStarted();
        return isset($_SESSION[$key]);
    }

    public function remove(string $key)
    {
        $this->checkSessionStarted();
        unset($_SESSION[$key]);
    }

    public function checkSessionStarted()
    {
        if(!$this->hasStarted()){
            throw new \LogicException('Session is not started yet');
        }
    }
}