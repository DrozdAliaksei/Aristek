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
     *
     * @param UserModel $userModel
     * @param array     $data
     */
    public function __construct(UserModel $userModel, array $data = [])
    {
        $this->userModel = $userModel;
        $this->data = $data;
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {

        $this->data['login'] = $request->get('login');
        $this->data['plain_password'] = $request->get('plain_password');
        $this->data['plain_password_confirm'] = $request->get('plain_password_confirm');
        $this->data['roles'] = (array) $request->get('roles', []);

        $id = $this->data['id'] ?? null;
        if ($this->userModel->checkLogin($this->data['login'], $id)) {
            $this->violations['login'] = 'Such login exists';
        }
        if (strlen($this->data['plain_password']) < 5) {
            $this->violations['plain_password'] = 'Password is too short';
        } elseif (strlen($this->data['plain_password']) > 30) {
            $this->violations['plain_password'] = 'Password is too long';
        } elseif ($this->data['plain_password'] !== $this->data['plain_password_confirm']) {
            $this->violations['plain_password_confirm'] = 'Password conformation doesn\'t match password';
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
        $data = $this->data;
        unset($data['plain_password_confirm']);

        return $data;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->violations) === 0;
    }
}