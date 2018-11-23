<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:38
 */

namespace Core\Request;

class Request
{
    const POST = 'POST';
    const GET = 'GET';
    /**
     * @var array
     */
    public $request;

    /**
     * @var string
     */
    private $path;
    private $method;

    /**
     * Request constructor.
     * @param string $path
     * @param string $method
     * @param array $request
     */
    public function __construct(string $path, string $method, array $request)
    {
        $this->path = $path;
        $this->request = $request;
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function get(string $key, $default = null)
    {
        return $this->request[$key] ?? $default;
    }
}