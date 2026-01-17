<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Income;
use App\Models\Card;

class IncomeController extends Controller
{
    private Income $incomeModel;
    private Card $cardModel;

    public function __construct()
    {
        $this->incomeModel = new Income();
        $this->cardModel = new Card();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $incomes = $this->incomeModel->getByUserId($userId);
        $this->view('incomes/index.view', ['incomes' => $incomes]);
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
                'card_id' => $_POST['card_id'] ?? null, // Income might go to a card
                'date' => $_POST['date']
            ];

            if ($this->incomeModel->create($data)) {
                $this->redirect('/dashboard');
            } else {
                // error
            }
        } else {
            $cards = $this->cardModel->getByUserId($_SESSION['user_id']);
            $this->view('incomes/create.view', ['cards' => $cards]);
        }
    }
}