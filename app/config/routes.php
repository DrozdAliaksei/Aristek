<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:41
 */

use Core\Router\Router;

Router::add('/login', \Controller\SecurityController::class, 'login');
Router::add('/profile', \Controller\UsersController::class, 'profile');
Router::add('/logout', \Controller\SecurityController::class, 'logout');
Router::add('/users', \Controller\UsersController::class, 'list');
Router::add('/users/create', \Controller\UsersController::class, 'create');
Router::add('/users/{id}/edit', \Controller\UsersController::class, 'edit', ['id' => '\d+']);
Router::add('/users/{id}/delete', \Controller\UsersController::class, 'delete', ['id' => '\d+']);

Router::add('/rooms', \Controller\RoomsController::class, 'list');
Router::add('/rooms/create', \Controller\RoomsController::class, 'create');
Router::add('/rooms/{id}/edit', \Controller\RoomsController::class, 'edit', ['id' => '\d+']);
Router::add('/rooms/{id}/delete', \Controller\RoomsController::class, 'delete', ['id' => '\d+']);

Router::add('/equipments', \Controller\EquipmentsController::class, 'list');
Router::add('/equipments/create', \Controller\EquipmentsController::class, 'create');
Router::add('/equipments/{id}/edit', \Controller\EquipmentsController::class, 'edit', ['id' => '\d+']);
Router::add('/equipments/{id}/delete', \Controller\EquipmentsController::class, 'delete', ['id' => '\d+']);

Router::add('/installation-scheme', \Controller\InstallationSchemeController::class, 'list');
Router::add('/installation-scheme/create', \Controller\InstallationSchemeController::class, 'create');
Router::add('/installation-scheme/{id}/edit', \Controller\InstallationSchemeController::class, 'edit', ['id' => '\d+']);
Router::add('/installation-scheme/{id}/delete', \Controller\InstallationSchemeController::class, 'delete', ['id' => '\d+']);
Router::add('/installation-scheme/{id}/{status}/change-status', \Controller\InstallationSchemeController::class, 'changeStatus', ['id' => '\d+','status' => '\d+']);
