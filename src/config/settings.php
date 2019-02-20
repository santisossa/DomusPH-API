<?php
require __DIR__ . '/env.php';
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../../templates/',
        ],

        // Database conection
        'db' => [
            'driver' => DATABASE['driver'] ?? 'my-driver',
            'host' => DATABASE['host'] ?? 'my-host',
            'database' => DATABASE['database' ?? 'my-database'],
            'username' => DATABASE['username'] ?? 'my-username',
            'password' => DATABASE['password'] ?? 'my-password',
            'charset' => DATABASE['charset'] ??'utf8',
            'collation' => DATABASE['collation'] ??'utf8_unicode_ci',
            'prefix' => DATABASE['prefix'] ??'',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'domusph-api',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
