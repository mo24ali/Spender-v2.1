<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;



$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$db_credentials = [
    'host' => 'localhost',
    'username' => $_ENV['DATABASE_USERNAME'],
    'password' => $_ENV['DATABASE_PASSWORD'],
    'dbname' => 'spender'
];
// var_dump($db_credentials);
return $db_credentials;
