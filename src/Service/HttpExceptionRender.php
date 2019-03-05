<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 5.3.19
 * Time: 14.24
 */

namespace Service;

use Core\HTTP\Exception\HttpExceptionInterface;
use Core\Response\Response;
use Core\Response\TemplateResource;
use Core\Template\Renderer;

class HttpExceptionRender
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function createResponse(HttpExceptionInterface $exception)
    {
        $code = $exception->getCode();
        $message = $exception->getMessage();
        $path = 'Core/http_exception.php';

        return new Response($this->renderer->render($path, ['code' => $code, 'message' => $message]), $code);
    }
}