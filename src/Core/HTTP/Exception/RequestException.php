<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 19:01
 */

namespace Core\HTTP\Exception;

use Throwable;

class RequestException extends \Exception implements  HttpExceptionInterface
{
    /**
     * RequestException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}