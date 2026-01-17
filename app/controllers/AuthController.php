<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{

    public function splash()
    {
        require __DIR__ . '/../views/auth/splash.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];
                header('Location: /spender-v2/public/dashboard'); // Adjust path as needed based on Router
                exit;
            } else {
                return $this->view('auth/login', ['error' => 'Invalid credentials']);
            }
        }

        return $this->view('auth/login');
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
                return $this->view('auth/register', ['error' => 'All fields are required']);
            }

            $userModel = new User();
            if ($userModel->findByEmail($email)) {
                return $this->view('auth/register', ['error' => 'Email already exists']);
            }

            if ($userModel->register($firstname, $lastname, $email, $password)) {
                header('Location: /spender-v2/public/auth/login');
                exit;
            } else {
                return $this->view('auth/register', ['error' => 'Registration failed']);
            }
        }

        return $this->view('auth/register');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /spender-v2/public/auth/login');
        exit;
    }
}
