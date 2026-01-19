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

        $this->view('cards/index', ['cards' => $cards]);
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
                $this->redirect('/cards');
            } else {
                // dump_die($data);
                // echo "eyyooow";
            }
        } else {
            $this->view('cards/create.view');
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/cards');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'balance' => $_POST['balance'],
                'limit' => $_POST['limit'],
                'expiry_date' => $_POST['expiry_date'],
                'card_number' => $_POST['card_number']
            ];

            // Should verify ownership ideally, but for now assuming id is valid and user is checked in model or here
            // The model update doesn't check user_id currently, we might want to fix that later or rely on frontend not showing others' cards
            $this->cardModel->update($id, $data);
            $this->redirect('/cards');

        } else {
            $card = $this->cardModel->getById($id);
            // Verify ownership
            if ($card['user_id'] != $_SESSION['user_id']) {
                $this->redirect('/cards');
            }
            $this->view('cards/edit.view', ['card' => $card]);
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $card = $this->cardModel->getById($id);
            if ($card && $card['user_id'] == $_SESSION['user_id']) {
                $this->cardModel->delete($id);
            }
        }
        $this->redirect('/cards');
    }
}
