<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 16:26
 */

namespace Core\Security;


use Core\Request\Request;
use Core\Response\RedirectResponse;
use Core\Router\Route;

interface MiddlewareInterface
{
    /**
     * @param Route $route
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function handle(Route $route, Request $request);
}