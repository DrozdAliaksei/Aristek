<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.54
 */


use Core\Request\RequestFactory;

require __DIR__.'/../app/autoload.php';
$kernel = new Kernel();

try {
    $request = RequestFactory::createRequest();
    $response = $kernel->createResponse($request);
    $response->send();
} catch (\Exception $exception) {
    //TODO create response
    #echo 'app_exception';
    echo $exception->getMessage();
}
