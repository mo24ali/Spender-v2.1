<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    private $cardModel;
    private $transactionModel;

    public function __construct()
    {
        $this->cardModel = new \App\Models\Card();
        $this->transactionModel = new \App\Models\Transaction();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $cards = $this->cardModel->getByUserId($userId);
        $recentTransactions = $this->transactionModel->getByUserId($userId); // Assuming this returns all, limit in View or Model? Model had 'ORDER BY DESC'. Better limit here or in model.

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'cards' => $cards,
            'recentTransactions' => array_slice($recentTransactions, 0, 5)
        ]);
    }
}