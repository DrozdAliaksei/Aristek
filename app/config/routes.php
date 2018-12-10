<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:41
 */

use Core\Router\Router;

Router::add('/users', \Controller\UsersController::class, 'list');
Router::add('/users/create', \Controller\UsersController::class, 'create');
Router::add('/users/{id}/edit', \Controller\UsersController::class, 'edit', ['id' => '\d+']);
Router::add('/users/{id}/delete', \Controller\UsersController::class, 'delete', ['id' => '\d+']);

Router::add('/rooms', \Controller\RoomsController::class, 'list');
Router::add('/rooms/create', \Controller\RoomsController::class, 'create');
Router::add('/rooms/{id}/edit', \Controller\RoomsController::class, 'edit', ['id' => '\d+']);
Router::add('/rooms/{id}/delete', \Controller\RoomsController::class, 'delete', ['id' => '\d+']);
