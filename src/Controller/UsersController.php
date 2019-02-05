<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\HTTP\Session;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Template\Renderer;
use Form\UserForm;
use Model\UserModel;

class UsersController
{
    /**
     * @var UserModel
     */
    private $userModel;
    /**
     * @var Session
     */
    private $session;

    /**
     * UsersController constructor.
     *
     * @param UserModel $user
     * @param Session   $session
     * @param Renderer  $renderer
     */
    public function __construct(UserModel $user, Session $session, Renderer $renderer )
    {
        $this->userModel = $user;
        $this->session = $session;
        $this->renderer = $renderer;

    }

    /**
     * @return Response
     */
    public function list(/* Request $request */)
    {
        $user = $this->session->get('user');
        echo json_encode($this->session->get('user'));
        $users = $this->userModel->getList();
        $path = 'Users/list.php';

        return new Response($this->renderer->render($path,['users' => $users]));
    }

    /**
     * @return UserModel
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
     * @throws \Exception
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $user = $this->userModel->getUser($id);
        if($user === null){
            throw new \Exception('User not found');
        }
        $form = new UserForm($this->userModel, $user );
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
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->userModel->delete($id);
        return new RedirectResponse('/users');
    }
}