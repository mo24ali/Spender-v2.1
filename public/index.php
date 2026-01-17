<?php
namespace App\public;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\TransactionController;

$app = new App();
$router = $app->getRouter();

$router->get('/', [AuthController::class, 'splash']);
$router->get('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/signup', [AuthController::class, 'signup']);
$router->post('/auth/signup', [AuthController::class, 'signup']);
$router->get('/auth/logout', [AuthController::class, 'logout']);

// Dashboard Routes
$router->get('/dashboard', [DashboardController::class, 'index']);

// Transaction Routes
$router->get('/transaction/index', [TransactionController::class, 'index']);
$router->post('/transaction/create', [TransactionController::class, 'create']);
$router->get('/transaction/delete', [TransactionController::class, 'delete']);

$app->run();
