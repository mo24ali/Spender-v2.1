<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transfer;
use App\Models\Card;

class TransferController extends Controller
{
    private Transfer $transferModel;
    private Card $cardModel;

    public function __construct()
    {
        $this->transferModel = new Transfer();
        $this->cardModel = new Card();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'sender_id' => $_POST['sender_id'], // Card ID
                'sender_type' => 'card',
                'receiver_id' => $_POST['receiver_id'], // Card ID
                'receiver_type' => 'card',
                'amount' => $_POST['amount']
            ];

            if ($this->transferModel->create($data)) {
                $this->redirect('/dashboard');
            } else {
                // error
                $this->redirect('/transfer/create?error=failed');
            }
        } else {
            $userId = $_SESSION['user_id'];
            $cards = $this->cardModel->getByUserId($userId);
            $this->view('transfers/create.view', ['cards' => $cards]);
        }
    }
}
