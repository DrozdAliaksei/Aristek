<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:37
 */

namespace Core\Response;

class RedirectResponse extends Response
{
    private $url;

    /**
     * Response constructor.
     * @param $content
     */
    public function __construct($url, int $code = self::REDIRECT_FOUND)
    {
        $this->resourse = new EmptyResource();
        $this->headers= ['Location'=> $url];
    }
}