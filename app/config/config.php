<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.52
 */

return [
    'parameters' => [
        'database'     => [
            'dsn'      => 'mysql:host=localhost; dbname=basic',
            'user'     => 'root',
            'password' => '1967',
        ],
        'menu'         => require __DIR__.'/menu.php',
        'security'     => require __DIR__.'/security.php',
        'template_dir' => __DIR__.'/../view',
    ],
    'services'   => require __DIR__.'/services.php',
];