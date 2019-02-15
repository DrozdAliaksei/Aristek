<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 12.12.18
 * Time: 19:12
 */

namespace Core\Security;

class StringBuilder
{
    public function build(int $length): string
    {
        $string = '';
        $stack = 'AZXCVBNMsdrfghbv2345tgvccrgtrhgfvcbr34654xzsdfg';
        $max = strlen($stack) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = random_int(0, $max); // rand
            $string .= $stack[$rand];
        }

        return $string;
    }
}