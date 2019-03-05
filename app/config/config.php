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
            'dsn'      => 'mysql:host=localhost; dbname=smart-home',
            'user'     => 'root',
            'password' => '@r1st3k',
        ],
        'menu'         => require __DIR__.'/menu.php',
        'security'     => require __DIR__.'/security.php',
        'template_dir' => __DIR__.'/../view',
    ],
    'services'   => require __DIR__.'/services.php',
];