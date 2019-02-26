<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 17:07
 */

namespace Middleware;


use Core\HTTP\Exception\UnauthorizedException;
use Core\Request\Request;
use Core\Response\RedirectResponse;
use Core\Router\Route;
use Core\Security\MiddlewareInterface;
use Service\SecurityService;

class RoleMiddleware implements MiddlewareInterface
{
    /**
     * @var array
     */
    private $routeSecurity;
    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * RoleMiddleware constructor.
     *
     * @param array           $routeSecurity
     * @param SecurityService $securityService
     */
    public function __construct(array $routeSecurity, SecurityService $securityService)
    {
        $this->routeSecurity = $routeSecurity;
        $this->securityService = $securityService;
    }


    /**
     * @param Route $route
     * @param Request $request
     * @return RedirectResponse|null
     * @throws UnauthorizedException
     */
    public function handle(Route $route, Request $request)
    {
        $role = $this->securityService->getRole();
        $isAuthenticated = $this->isAuthenticated($request->getPath(), $role);
        if ($isAuthenticated === false) {
            throw new UnauthorizedException();
        }

        return null;
    }

    private function isAuthenticated(string $path, string $role)
    {
        foreach ($this->routeSecurity as $pattern => $routeRoles) {
            if (preg_match(sprintf('#%s#', $pattern), $path)) {
                return in_array($role, $routeRoles);
            }
        }

        return null;
    }
}