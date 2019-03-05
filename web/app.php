<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.54
 */

use Core\HTTP\Exception\HttpExceptionInterface;
use Core\Request\RequestFactory;
use Service\HttpExceptionRender;

require __DIR__.'/../app/autoload.php';
$kernel = new Kernel();

try {
    $request = RequestFactory::createRequest();
    $response = $kernel->createResponse($request);
    $response->send();
}catch (HttpExceptionInterface $exception){
    /** @var HttpExceptionRender $exceptionRenderer */
    $exceptionRenderer = $kernel->getContainer()->get(HttpExceptionRender::class);
    $response = $exceptionRenderer->createResponse($exception);
    $response->send();
}
catch (\Exception $exception) {
    echo $exception->getMessage();
}
