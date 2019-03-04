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
     * @var \Throwable
     */
    private $previous;

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
        $this->message = $message;
        $this->code = $code;
        $this->previous = $previous;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getHeaders(): array
    {

    }
}