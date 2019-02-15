<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 18:10
 */

namespace Form;

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
     *
     * @param SecurityService $securityService
     */
    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
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

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->violations) === 0;
    }

    /**
     * @param \Core\Request\Request $request
     */
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