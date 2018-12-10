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
    echo $exception->getMessage();
}
//ToDo 1)авторизация через сессию   ,работа с сессиями на php.net
//TODO 2) меню,
//TODO 3)приложение через основные части