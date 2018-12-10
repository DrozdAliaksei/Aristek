<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 01.12.18
 * Time: 21:43
 */

namespace Form;

use Core\Request\Request;
use Enum\RolesEnum;
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
        $this->data = $data;
    }

    public function handleRequest(Request $request)
    {

        $this->data['login'] = $request->get('login');
        $this->data['password'] = $request->get('password');
        $this->data['roles'] = (array)$request->get('roles', []);

        $id = $this->data['id'] ?? null;
        if ($this->userModel->checkLogin($this->data['login'], $id)) {
            $this->violations['login'] = 'Such login exists';
        }
        if (strlen($this->data['password']) < 5) {
            $this->violations['password'] = 'Password is too short';
        } elseif (strlen($this->data['password']) > 30) {
            $this->violations['password'] = 'Password is too long';
        }
        if (!$this->data['roles']) {
            $this->violations['roles'] = 'At least, one role is required';
        } elseif (array_diff($this->data['roles'], RolesEnum::getAll())) {
            $this->violations['roles'] = 'Invalid roles';
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
        return count($this->violations) === 0;
    }

}