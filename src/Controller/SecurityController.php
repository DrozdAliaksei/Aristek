<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 17:22
 */

namespace Controller;


use Core\HTTP\Session;
use Core\Request\Request;
use Core\Response\{JSONResource, RedirectResponse, Response};
use Core\Template\Renderer;
use Form\LoginForm;
use Service\SecurityService;

class SecurityController
{
    /**
     * @var SecurityService
     */
    private $securityService;
    /**
     * @var Session
     */
    private $session;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * SecurityController constructor.
     *
     * @param SecurityService $securityService
     * @param Session         $session
     * @param Renderer        $renderer
     */
    public function __construct(SecurityService $securityService, Session $session, Renderer $renderer)
    {
        $this->securityService = $securityService;
        $this->session = $session;
        $this->renderer = $renderer;
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function login(Request $request)
    {
        $form = new LoginForm($this->securityService);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->securityService->authorize($form->getData());

                return new RedirectResponse('/installation-scheme');
            }
        }
        $path = 'Users/login.php';

        return new Response($this->renderer->render($path, ['form' => $form]));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function loginMob(Request $request)
    {
        $form = new LoginForm($this->securityService);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->securityService->authorize($form->getData());
                return new Response(new JSONResource('connection_status',"true"));
            }
        }

        return new Response(new JSONResource('connection_status',["false"]));
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->securityService->logout();

        return new RedirectResponse('/login');
    }
}