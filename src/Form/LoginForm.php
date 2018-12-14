<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 18:10
 */

namespace Form;


use Model\UserModel;
use Service\SecurityService;

class LoginForm
{

    private $data = [];
    private $violations = [];
    /**
     * @var SecurityService
     */
    private $securityService;

    /**
     * LoginForm constructor.
     */
    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }

    public function getViolations(): array
    {
        return $this->violations;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function isValid()
    {
        return count($this->violations) === 0;
    }

    public function handleRequest(\Core\Request\Request $request)
    {
        $this->data['login'] = $login = $request->get('login');
        $this->data['password'] = $password = $request->get('password');


        if ($login && $this->securityService->userExist($login)) {
            if (!$password || !$this->securityService->isPasswordValid($login, $password)) {
                $this->violations['password'] = 'Invalid credentials ps';
            }
        } else {
            $this->violations['login'] = 'Invalid credentials lg';

        }
    }
}