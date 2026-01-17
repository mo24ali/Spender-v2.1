<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    private Transaction $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $transactions = $this->transactionModel->getByUserId($userId);

        $this->view('transactions/index.view', ['transactions' => $transactions]);
    }
}
