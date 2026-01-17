<?php
namespace App\public;
require_once __DIR__ . '/../vendor/autoload.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// use App\Core\Database;
use App\Core\App;
// use App\Controllers\AuthController;
// use App\Controllers\DashboardController;
// use App\Controllers\CardController;
// use App\Controllers\ExpenseController;
// use App\Controllers\IncomeController;
// use App\Controllers\TransferController;
// use App\Controllers\TransactionController;




$app = new App();
// $router = $app->getRouter();

// // Auth Routes
// $router->get('/', [AuthController::class, 'login']);
// $router->get('/auth/login', [AuthController::class, 'login']);
// $router->post('/auth/login', [AuthController::class, 'login']);
// $router->get('/auth/signup', [AuthController::class, 'signup']);
// $router->post('/auth/signup', [AuthController::class, 'signup']);
// $router->get('/auth/logout', [AuthController::class, 'logout']);

// // Dashboard Routes
// $router->get('/dashboard', [DashboardController::class, 'index']);
// $router->get('/dashboard/index', [DashboardController::class, 'index']);

// // Card Routes
// $router->get('/card/index', [CardController::class, 'index']);
// $router->get('/card/create', [CardController::class, 'create']);
// $router->post('/card/create', [CardController::class, 'create']);

// // Expense Routes
// $router->get('/expense/index', [ExpenseController::class, 'index']);
// $router->get('/expense/create', [ExpenseController::class, 'create']);
// $router->post('/expense/create', [ExpenseController::class, 'create']);

// // Income Routes
// $router->get('/income/index', [IncomeController::class, 'index']);
// $router->get('/income/create', [IncomeController::class, 'create']);
// $router->post('/income/create', [IncomeController::class, 'create']);

// // Transfer & Transaction Routes
// $router->get('/transfer/create', [TransferController::class, 'create']);
// $router->post('/transfer/create', [TransferController::class, 'create']);
// $router->get('/transaction/index', [TransactionController::class, 'index']);

$app->run();

echo "index";