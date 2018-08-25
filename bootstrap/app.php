<?php

//namespace \App\bootstrap;

require __DIR__ . '/../vendor/autoload.php';

// pengaturan file environment .env
$dotenv = new Dotenv\Dotenv(__DIR__, '../.env');
$dotenv->load();


$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
         'db' => [
            'driver'   => 'mysql',
            'host'     => 'localhost',
            'database' => 'warehouse',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
]);
