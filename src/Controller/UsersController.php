<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:43
 */

namespace Controller;

use Core\Request\Request;
use Core\Response\Response;
use Model\UserModel;

class UsersController
{
    /**
     * @var UserModel
     */
    private $model;

    public function __construct(UserModel $user)
    {
        $this->userModel = $user;
    }

    //TODO implement actions (methods)

    public function list(/* Request $request */)
    {
        $users = $this->userModel->getList();
        ob_start();
        require __DIR__.'/../../app/view/Users/list.php';
        $content = ob_get_contents();
        ob_end_clean();
        #echo 'list and return Response'.PHP_EOL;
        return new Response($content);
    }

    /**
     * @return UserModel
     */
    public function create(Request $request)
    {
        if($request->getMethod() === Request::POST){
            $user = [
                'login'=>$request->get('login'),
                'password'=>$request->get('password'),
                'roles'=>(array)$request->get('roles',[])
            ];
            $this->userModel->create($user);
        }
        ob_start();
        require __DIR__.'/../../app/view/Users/create.php';
        $content = ob_get_contents();
        ob_end_clean();
        return new Response($content);
    }
}