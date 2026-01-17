<?php


//the base controller

namespace App\Core;


class Controller
{
    protected $request;
    protected function redirect(string $path)
    {

    }



    protected function view(string $view, array $data = [])
    {
        extract($data);
        require __DIR__ . "/../Views/$view.php";
    }

}
