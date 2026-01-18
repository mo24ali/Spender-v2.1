<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transaction;
use App\Models\Category;

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

        $categoryModel = new Category();
        $categories = $categoryModel->getAll($_SESSION['user_id']);

        return $this->view('transactions/index', [
            'transactions' => $transactions,
            'categories' => $categories
        ]);
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
        } else {
            // Fetch categories for the dropdown
            $categoryModel = new Category();
            $categories = $categoryModel->getAll($_SESSION['user_id']);
            $this->view('transactions/create', ['categories' => $categories]);
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /spender-v2/public/auth/login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /spender-v2/public/dashboard');
            exit;
        }

        $transactionModel = new Transaction();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $type = $_POST['type'];
            $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : null;

            $transactionModel->update($id, $title, $amount, $date, $type, $_SESSION['user_id'], $categoryId);
            header('Location: /spender-v2/public/dashboard');
            exit;

        } else {
            $transaction = $transactionModel->getById($id, $_SESSION['user_id']);
            if (!$transaction) {
                header('Location: /spender-v2/public/dashboard');
                exit;
            }

            $categoryModel = new Category();
            $categories = $categoryModel->getAll($_SESSION['user_id']);

            $this->view('transactions/edit', [
                'transaction' => $transaction,
                'categories' => $categories
            ]);
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
