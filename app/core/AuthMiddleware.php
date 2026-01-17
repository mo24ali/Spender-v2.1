<?php

namespace App\Core;

class AuthMiddleware
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit();
        }
    }

    public static function isAdmin()
    {
        self::check();
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /dashboard');
            exit();
        }
    }

    public static function isGuest()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit();
        }
    }
}
