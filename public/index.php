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

$router->get('/cards', function () {
    (new \App\Controllers\CardController())->index();
});

$router->get('/cards/create', function () {
    (new \App\Controllers\CardController())->create();
});

$router->post('/cards/create', function () {
    (new \App\Controllers\CardController())->create();
});

$router->get('/cards/edit', function () {
    (new \App\Controllers\CardController())->edit();
});

$router->post('/cards/edit', function () {
    (new \App\Controllers\CardController())->edit();
});

$router->get('/cards/delete', function () {
    (new \App\Controllers\CardController())->delete();
});

/*
|--------------------------------------------------------------------------
| Incomes
|--------------------------------------------------------------------------
*/
$router->get('/incomes', function () {
    (new \App\Controllers\IncomeController())->index();
});

$router->get('/incomes/create', function () {
    (new \App\Controllers\IncomeController())->create();
});

$router->post('/incomes/create', function () {
    (new \App\Controllers\IncomeController())->create();
});

/*
|--------------------------------------------------------------------------
| Expenses
|--------------------------------------------------------------------------
*/
$router->get('/expenses', function () {
    (new \App\Controllers\ExpenseController())->index();
});

$router->get('/expenses/create', function () {
    (new \App\Controllers\ExpenseController())->create();
});

$router->post('/expenses/create', function () {
    (new \App\Controllers\ExpenseController())->create();
});

/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/
$router->get('/categories', function () {
    (new \App\Controllers\CategoryController())->index();
});

$router->get('/categories/create', function () {
    (new \App\Controllers\CategoryController())->create();
});

$router->post('/categories/create', function () {
    (new \App\Controllers\CategoryController())->create();
});

$router->get('/categories/delete', function () {
    (new \App\Controllers\CategoryController())->delete();
});

/*
|--------------------------------------------------------------------------
| Transactions (Legacy/General)
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

$router->get('/transaction/edit', function () {
    (new TransactionController())->edit();
});

$router->post('/transaction/edit', function () {
    (new TransactionController())->edit();
});

$app->run();
