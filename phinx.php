<?php

require __DIR__ . '/vendor/vlucas/phpdotenv/src/Dotenv.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => $_ENV['ENVIRONMENT'],
        'production' => [
            'adapter' => $_ENV['DBDRIVER'],
            'host' => $_ENV['DBHOST'],
            'name' => $_ENV['DBNAME'],
            'user' => $_ENV['DBUSER'],
            'pass' => empty($_ENV['DBPASS']) ? '' : $_ENV['DBPASS'],
            'port' => $_ENV['DBPORT'],
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => $_ENV['DBDRIVER'],
            'host' => $_ENV['DBHOST'],
            'name' => $_ENV['DBNAME'],
            'user' => $_ENV['DBUSER'],
            'pass' => empty($_ENV['DBPASS']) ? '' : $_ENV['DBPASS'],
            'port' => $_ENV['DBPORT'],
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => $_ENV['DBDRIVER'],
            'host' => $_ENV['DBHOST'],
            'name' => $_ENV['DBNAME'],
            'user' => $_ENV['DBUSER'],
            'pass' => empty($_ENV['DBPASS']) ? '' : $_ENV['DBPASS'],
            'port' => $_ENV['DBPORT'],
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
