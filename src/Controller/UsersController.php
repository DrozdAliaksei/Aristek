<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Template\Renderer;
use Exception;
use Form\ProfileForm;
use Form\UserForm;
use Model\UserModel;
use Service\SecurityService;

class UsersController
{
    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * UsersController constructor.
     *
     * @param UserModel       $user
     * @param Renderer        $renderer
     * @param SecurityService $securityService
     */
    public function __construct(UserModel $user, Renderer $renderer, SecurityService $securityService)
    {
        $this->userModel = $user;
        $this->renderer = $renderer;
        $this->securityService = $securityService;
    }

    /**
     * @return Response
     */
    public function list(/* Request $request */): Response
    {
        $users = $this->userModel->getList();
        $path = 'Users/list.php';

        return new Response($this->renderer->render($path, ['users' => $users]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function profile(Request $request)
    {
        $form = new ProfileForm($this->userModel);
        if($request->getMethod() === Request::POST){
            $form->handleRequest($request);
            if($form->isValid()){
                $id = $this->securityService->getUser()['id'];
                $this->userModel->changePassword($form->getData(),$id);

                return new RedirectResponse('/users');
            }
        }

        $user = $this->securityService->getUser();
        $path = 'Users/profile.php';

        return new Response($this->renderer->render($path,['user' => $user, 'form' =>$form]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function create(Request $request)
    {
        $form = new UserForm($this->userModel);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->userModel->create($form->getData());

                return new RedirectResponse('/users');
            }
        }
        $path = 'Users/create.php';

        return new Response($this->renderer->render($path, ['form' => $form]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $user = $this->userModel->getUser($id);
        if ($user === null) {
            throw new Exception('User not found');
        }
        $form = new UserForm($this->userModel, $user);
        if ($request->getMethod() === Request::POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->userModel->edit($form->getData(), $id);

                return new RedirectResponse('/users');
            }
        }
        $path = 'Users/create.php';

        return new Response($this->renderer->render($path, ['form' => $form, 'user' => $user]));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $this->userModel->delete($id);

        return new RedirectResponse('/users');
    }
}