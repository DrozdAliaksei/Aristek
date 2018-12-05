<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:37
 */

namespace Core\Response;

class Response
{

    const NOT_FOUND = 404;
    const REDIRECT_FOUND = 302;
    const SUCCESS = 200;
    const CONTINUE = 100;
    const SWITCHING_PROTOCOL = 101;
    const ACCEPTED = 202;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const SEE_OTHER = 300;
    const NOT_MODIFIED = 304;
    const USE_PROXY = 305;
    const BAD_REQUEST = 400;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;


    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * @var array
     */
    protected $headers;

    /**
     * Response constructor.
     * @param ResourceInterface $resource
     * @param int $code
     * @param array $headers
     */
    public function __construct(ResourceInterface $resource, int $code = self::SUCCESS, array $headers = [])
    {

        $this->resource = $resource;
        array_unshift($headers, sprintf('HTTP/1.0 %d %s', $code, $this->getMessage($code)));
        $this->headers = $headers;
    }

    public function send()
    {
        foreach ($this->headers as $key => $value) {
            if (is_numeric($key)) {
                $header = $value;
            } else {
                $header = sprintf('%s: %s', $key, $value);
            }
            header($header);
        }
        echo $this->resource->getContent();
    }

    private function getMessage(int $code)
    {
        $message = [
            self::NOT_FOUND => 'NOT FOUND',
            self::REDIRECT_FOUND => 'REDIRECT FOUND',
            self::SUCCESS => 'SUCCESS',
            ];

        //ToDo fill masages
        return $message[$code] ?? '';
    }
}