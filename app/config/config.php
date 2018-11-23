<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.52
 */

return [
    'parameters' => [
         'database' => [
            'dsn' => 'mysql:host=localhost; dbname=basic',
            'user' => 'root',
            'password' => '1967',
        ]
    ],
    'services' => require_once __DIR__ . '/services.php',
];