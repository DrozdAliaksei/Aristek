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
    public function getHash(string $plainPassword, string $salt)
    {
        return md5($salt.'|'.$plainPassword);
    }

    public function createToken(string $salt, string $hash)
    {
        return sprintf('%s:%s',$salt,$hash);
    }

    public function getHashPart(string $token)
    {
        $parts = explode(':',$token,2);
        return $parts[1];
    }

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