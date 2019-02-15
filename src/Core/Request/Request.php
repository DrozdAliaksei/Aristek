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

    private $attributes;

    /**
     * Request constructor.
     *
     * @param string $path
     * @param string $method
     * @param array  $request
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

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return $this->request[$key] ?? $default;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }
}