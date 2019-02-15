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
    /**
     * Response constructor.
     *
     * @param     $url
     * @param int $code
     */
    public function __construct($url, int $code = self::REDIRECT_FOUND)
    {
        $resourse = new EmptyResource();
        $headers = ['Location' => $url];
        parent::__construct($resourse, $code, $headers);
    }
}