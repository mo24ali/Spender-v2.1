<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Expense;
use App\Models\Card;

class ExpenseController extends Controller
{
    private Expense $expenseModel;
    private Card $cardModel;

    public function __construct()
    {
        $this->expenseModel = new Expense();
        $this->cardModel = new Card();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $expenses = $this->expenseModel->getByUserId($userId);
        $this->view('expenses/index.view', ['expenses' => $expenses]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'user_id' => $_SESSION['user_id'],
                'amount' => $_POST['amount'],
                'category_id' => $_POST['category_id'] ?? null,
                'card_id' => $_POST['card_id'] ?? null,
                'due_date' => $_POST['due_date']
            ];

            if ($this->expenseModel->create($data)) {
                $this->redirect('/dashboard');
            } else {
                // error
            }
        } else {
            $cards = $this->cardModel->getByUserId($_SESSION['user_id']);
            $this->view('expenses/create.view', ['cards' => $cards]);
        }
    }
}