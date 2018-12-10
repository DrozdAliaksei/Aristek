<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

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

    public function __construct(UserModel $user)
    {
        $this->userModel = $user;
    }

    public function list(/* Request $request */)
    {
        $users = $this->userModel->getList();
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
                return new RedirectResponse('/app.php/users');
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

                return new RedirectResponse('/app.php/users');
            }
        }
        $path = __DIR__.'/../../app/view/Users/create.php';

        return new Response(new TemplateResource($path, ['form' => $form, 'user' => $user]));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
 //TODO throw exception if useer not exist
        $this->userModel->delete($id);
        return new RedirectResponse('/app.php/users');
    }
}