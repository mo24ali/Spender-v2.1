<?php



namespace App\Core;

// use Config\Router;

class App
{


    private Router $router;


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->router = new Router();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run()
    {
        $this->router->resolve();
    }
}
