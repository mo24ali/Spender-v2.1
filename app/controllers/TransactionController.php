<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /spender-v2/public/auth/login');
            exit;
        }

        $transactionModel = new Transaction();
        $transactions = $transactionModel->getAll($_SESSION['user_id']);

        return $this->view('transactions/index', ['transactions' => $transactions]);
    }

    public function create() // Reuses same method for generic add, or separate based on type param
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /spender-v2/public/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $type = $_POST['type']; // expense or income
            $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : null;

            $transactionModel = new Transaction();
            if ($transactionModel->create($title, $amount, $date, $type, $_SESSION['user_id'], $categoryId)) {
                header('Location: /spender-v2/public/dashboard');
                exit;
            }
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /spender-v2/public/auth/login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $transactionModel = new Transaction();
            $transactionModel->delete($id, $_SESSION['user_id']);
        }

        header('Location: /spender-v2/public/dashboard');
        exit;
    }
}
