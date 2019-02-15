<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 15.02.19
 * Time: 21:56
 */

namespace Form;

use Core\Request\Request;
use Model\UserModel;

class ProfileForm
{
    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $violations = [];

    /**
     * ProfileForm constructor.
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

    public function handleRequest(Request $request)
    {
        $this->data['plain_password'] = $request->get('plain_password');
        $this->data['plain_password_confirm'] = $request->get('plain_password_confirm');

        if (strlen($this->data['plain_password']) < 5) {
            $this->violations['plain_password'] = 'Password is too short';
        } elseif (strlen($this->data['plain_password']) > 30) {
            $this->violations['plain_password'] = 'Password is too long';
        } elseif ($this->data['plain_password'] !== $this->data['plain_password_confirm']) {
            $this->violations['plain_password_confirm'] = 'Password conformation doesn\'t match password';
        }
    }
}