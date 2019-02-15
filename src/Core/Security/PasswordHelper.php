<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 17:32
 */

namespace Core\Security;

class PasswordHelper
{
    /**
     * @param string $plainPassword
     * @param string $salt
     *
     * @return string
     */
    public function getHash(string $plainPassword, string $salt): string
    {
        return md5($salt.'|'.$plainPassword);
    }

    /**
     * @param string $salt
     * @param string $hash
     *
     * @return string
     */
    public function createToken(string $salt, string $hash): string
    {
        return sprintf('%s:%s',$salt,$hash);
    }

    /**
     * @param string $token
     *
     * @return mixed
     */
    public function getHashPart(string $token)
    {
        $parts = explode(':',$token,2);
        return $parts[1];
    }

    /**
     * @param string $token
     *
     * @return mixed
     */
    public function getSaltPart(string $token)
    {
        $parts = explode(':',$token,2);
        return $parts[0];
    }

    /**
     * @param string/null $token
     * @return bool
     */
    public function hasSalt($token) :bool
    {
        return $token && strpos($token,':');
    }
}