<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 23.01.19
 * Time: 19:01
 */

namespace Core\HTTP\Exception;

class NotFoundException extends RequestException
{
    /**
     * NotFoundException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = 'Not found', int $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}