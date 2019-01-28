<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\HTTP\Session;
use Core\Response\EmptyResource;
use Core\Response\RedirectResponse;
use Core\Response\Response;
use Core\Request\Request;
use Core\Response\TemplateResource;
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

    public function __construct(UserModel $user, Session $session)
    {
        $this->userModel = $user;
        $this->session = $session;
    }

    public function list(/* Request $request */)
    {
        $user = $this->session->get('user');
        echo json_encode($this->session->get('user'));
/*
        foreach ($user['roles'] as $role){
            if($role == 'Admin'){
                $users = $this->userModel->getList();
                $path = __DIR__.'/../../app/view/Users/list.php';
                return new Response(new TemplateResource($path, ['users' => $users]));
                break;
            }elseif ($role == 'User'){
                $users = $this->userModel->getList( ); // maybe show all list, and only for visitors don't show at all and redirect with violation
                $path = __DIR__.'/../../app/view/Users/list.php';
                return new Response(new TemplateResource($path, ['users' => $users]));
            }
        }
*/  //TODO think about showing list to all users or just for admin!
        $users = $this->userModel->getList(); //TODO создать метод в модели getUsersVisibleforRoles передать роли текущего пользователя вывести список пользователей который
        $path = __DIR__.'/../../app/view/Users/list.php';
        return new Response(new TemplateResource($path, ['users' => $users]));
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
                print_r($form->getViolations());
                $this->userModel->create($form->getData());
                return new RedirectResponse('/users');
            }
        }
        $path = __DIR__.'/../../app/view/Users/create.php';

        return new Response(new TemplateResource($path, ['form' => $form]));
    }

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
        $path = __DIR__.'/../../app/view/Users/create.php';

        return new Response(new TemplateResource($path, ['form' => $form, 'user' => $user]));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->userModel->delete($id);
        return new RedirectResponse('/users');
    }
}