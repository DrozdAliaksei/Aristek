<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 16:25
 */

namespace Core\Security;


use Core\Request\Request;
use Core\Response\RedirectResponse;
use Core\Router\Route;

class Guardian implements MiddlewareInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    private $sentinels;

    /**
     * Guardian constructor.
     * @param $sentinels
     */
    public function __construct(...$sentinels)
    {
        $this->sentinels = $sentinels;
    }


    /**
     * @param Route $route
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function handle(Route $route, Request $request)
    {
        foreach ($this->sentinels as $sentinel) {
            if ($response = $sentinel->handle($route, $request)) {
                return $response;
            }
        }

        return null;
    }
}