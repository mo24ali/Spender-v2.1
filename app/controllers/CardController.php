<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Card;

class CardController extends Controller
{
    private Card $cardModel;

    public function __construct()
    {
        $this->cardModel = new Card();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $cards = $this->cardModel->getByUserId($userId);

        $this->view('cards/index.view', ['cards' => $cards]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'user_id' => $_SESSION['user_id'],
                'balance' => $_POST['balance'],
                'limit' => $_POST['limit'],
                'expiry_date' => $_POST['expiry_date'],
                'card_number' => $_POST['card_number']
            ];

            if ($this->cardModel->create($data)) {
                $this->redirect('/card/index');
            } else {
                // Handle error
            }
        } else {
            $this->view('cards/create.view');
        }
    }
}
