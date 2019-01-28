<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 16:58
 */

namespace Middleware;


use Core\Request\Request;
use Core\Response\RedirectResponse;
use Core\Router\Route;
use Core\Security\MiddlewareInterface;
use Service\SecurityService;

class GuestMiddleware implements MiddlewareInterface
{
    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * GuestMiddleware constructor.
     */
    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }

    /**
     * @param Route $route
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function handle(Route $route, Request $request)
    {
        if(!$this->securityService->isAuthirized() && $request->getPath() !== '/login'){
            return new RedirectResponse('/app.php/login');
        }


        return null;
    }
}