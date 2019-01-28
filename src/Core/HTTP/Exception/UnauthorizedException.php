<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 19:01
 */

namespace Core\HTTP\Exception;

use Throwable;

class UnauthorizedException extends RequestException
{
    public function __construct(string $message = 'Unauthorized', int $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}