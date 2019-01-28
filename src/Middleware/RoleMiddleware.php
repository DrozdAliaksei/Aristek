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
        $roles = $this->securityService->getRoles();
        $isAuthenticated = $this->isAuthenticated($request->getPath(), $roles);
        if ($isAuthenticated === false) {
            throw new UnauthorizedException();//TODO maybe redirect with violations about low status of the role
        }

        return null;
    }

    private function isAuthenticated(string $path, array $roles)
    {
        foreach ($this->routeSecurity as $pattern => $routeRoles) {
            if (preg_match(sprintf('#%s#', $pattern), $path)) {
                return count(array_intersect($roles, $routeRoles)) > 0;
            }
        }

        return null;
    }
}