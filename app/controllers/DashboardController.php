<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /spender-v2/public/auth/login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $transactionModel = new Transaction();

        $recentTransactions = $transactionModel->getRecent($userId);
        $summary = $transactionModel->getSummary($userId);

        $totalIncome = $summary['income'] ?? 0;
        $totalExpense = $summary['expense'] ?? 0;
        $balance = $totalIncome - $totalExpense;

        $categoryModel = new \App\Models\Category();
        $categories = $categoryModel->getAll($userId);

        return $this->view('dashboard', [
            'user_name' => $_SESSION['user_name'],
            'transactions' => $recentTransactions,
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'balance' => $balance,
            'categories' => $categories
        ]);
    }
}