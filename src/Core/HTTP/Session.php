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

    /**
     * @return Session
     * @throws \Exception
     */
    public static function getInstance(): Session
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
            self::$instance->start();
        }
        return self::$instance;
    }

    /**
     * @throws \Exception
     */
    private function start()
    {
        if(!$this->hasStarted()){
            if(!session_start()){
                throw new \Exception('Session can not be started!');
            }
        }
    }

    /**
     * @return bool
     */
    private function hasStarted(): bool
    {
        return php_sapi_name()!== 'cli' && session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * @param string $key
     * @param        $value
     */
    public function set(string $key, $value)
    {
        $this->checkSessionStarted();
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        $this->checkSessionStarted();
        return$_SESSION[$key];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key) :bool
    {
        $this->checkSessionStarted();
        return isset($_SESSION[$key]);
    }

    /**
     * @param string $key
     */
    public function remove(string $key)
    {
        $this->checkSessionStarted();
        unset($_SESSION[$key]);
    }

    /**
     *
     */
    public function checkSessionStarted()
    {
        if(!$this->hasStarted()){
            throw new \LogicException('Session is not started yet');
        }
    }
}