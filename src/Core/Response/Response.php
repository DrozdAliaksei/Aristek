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
    private $content;

    /**
     * Response constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;
    }
}