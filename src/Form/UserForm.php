<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 01.12.18
 * Time: 21:43
 */

namespace Form;

use Core\Request\Request;
use Model\UserModel;


class UserForm
{

    private $data;
    private $violations = [];
    private $userModel;

    /**
     * UserForm constructor.
     * @param UserModel $userModel
     * @param array $user
     */
    public function __construct(UserModel $userModel, array $data = [])
    {
        $this->userModel = $userModel;
        $this->data['login'] = $data['login'];
        $this->data['password'] = $data['password'];
        $this->data['roles'] = $data['roles'];
    }

    public function handleRequest(Request $request)
    {
        $this->data = [
            'login' => $request->get('login'),
            'password' => $request->get('password'),
            'roles' => (array)$request->get('roles', [])
        ];
        if ($this->userModel->checkLogin($this->data['login'])) {
            $this->violations['login_error: '] = 'such login exists';
        }
        if (strlen($this->data['password']) < 5) {
            $this->violations['password_error: '] = 'password is too short';
        }
        elseif (strlen($this->data['password']) > 30) {
            $this->violations['password_error: '] = 'password is too long';
        }
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function isValid()
    {
        //TODO проверить был ли обработан handlerequest
        return count($this->violations) === 0 ;
    }

}