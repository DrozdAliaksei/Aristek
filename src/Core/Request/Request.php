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

    /**
     * @var array
     */
    public $request;

    /**
     * @var string
     */
    private $path;

    /**
     * Request constructor.
     * @param array $get
     */
    public function __construct(string $path,array $request)
    {
        $this->path = $path;
        $this->request = $request;
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
}