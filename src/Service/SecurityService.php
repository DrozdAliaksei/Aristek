<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 17:31
 */

namespace Service;

use Core\HTTP\Session;
use Core\Security\PasswordHelper;
use Model\UserModel;

/**
 * Class SecurityService
 * @package Service
 */
class SecurityService
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var PasswordHelper
     */
    private $passwordHelper;

    /**
     * SecurityService constructor.
     *
     * @param Session        $session
     * @param UserModel      $userModel
     * @param PasswordHelper $passwordHelper
     */
    public function __construct(Session $session, UserModel $userModel, PasswordHelper $passwordHelper)
    {

        $this->session = $session;
        $this->userModel = $userModel;
        $this->passwordHelper = $passwordHelper;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->session->has('user');
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->remove('user');
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function authorize(array $credentials): bool
    {
        if (!$this->isPasswordValid($credentials['login'], $credentials['password'])) {
            return false;
        }
        $user = $this->userModel->findByLogin($credentials['login']);
        $this->session->set('user', $user);

        return true;
    }

    /**
     * @param string $login
     *
     * @return bool
     */
    public function userExist(string $login): bool
    {
        return (bool) $this->userModel->findByLogin($login);
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function isPasswordValid(string $login, string $password): bool
    {
        $user = $this->userModel->findByLogin($login);
        if (!$user) {
            return false;
        }
        $salt = $this->passwordHelper->getSaltPart($user['password']);
        $hashPart = $this->passwordHelper->getHashPart($user['password']);
        $hash = $this->passwordHelper->getHash($password, $salt);

        return $hash === $hashPart;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        if ($this->isAuthorized()) {
            return $this->session->get('user')['roles'];
        }

        return [];
    }

    /**
     * @return array|null
     */
    public function getUser()
    {
        return $this->session->get('user');
    }
}