<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
        }

        $categories = $this->categoryModel->getAll($_SESSION['user_id']);
        $this->view('categories/index.view', ['categories' => $categories]);
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type']; // income or expense

            if ($this->categoryModel->create($name, $type, $_SESSION['user_id'])) {
                $this->redirect('/categories');
            } else {
                // handle error
            }
        } else {
            $this->view('categories/create.view');
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->categoryModel->delete($id, $_SESSION['user_id']);
        }
        $this->redirect('/categories');
    }
}