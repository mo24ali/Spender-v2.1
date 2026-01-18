<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\TransactionController;

$app = new App();
$router = $app->getRouter();

/*
|--------------------------------------------------------------------------
| Splash & Auth Routes
|--------------------------------------------------------------------------
*/
$router->get('/', function () {
    (new AuthController())->splash();
});

$router->get('/auth/login', function () {
    (new AuthController())->login();
});

$router->post('/auth/login', function () {
    (new AuthController())->login();
});

$router->get('/auth/signup', function () {
    (new AuthController())->signup();
});

$router->post('/auth/signup', function () {
    (new AuthController())->signup();
});

$router->get('/auth/logout', function () {
    (new AuthController())->logout();
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
$router->get('/dashboard', function () {
    (new DashboardController())->index();
});

/*
|--------------------------------------------------------------------------
| Transactions
|--------------------------------------------------------------------------
*/
$router->get('/transaction/index', function () {
    (new TransactionController())->index();
});

$router->post('/transaction/create', function () {
    (new TransactionController())->create();
});

$router->get('/transaction/delete', function () {
    (new TransactionController())->delete();
});

$app->run();
