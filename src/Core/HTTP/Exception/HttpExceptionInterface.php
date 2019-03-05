<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 27.02.19
 * Time: 18:44
 */

namespace Core\HTTP\Exception;

interface HttpExceptionInterface
{
    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string
     */
    public function getMessage();
}