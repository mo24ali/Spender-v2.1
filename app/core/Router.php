<?php

namespace App\Core;

class Router
{
    public array $routes = [];

    public function get(string $path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }
    public function post(string $path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove query string and trailing slash (optional, but good for consistency)
        // For now, simple path matching

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler) {
            // Support [Controller::class, 'method'] format
            if (is_array($handler)) {
                $controller = new $handler[0]();
                $action = $handler[1];
                call_user_func([$controller, $action]);
            } else {
                $handler();
            }
        } else {
            $this->handleNotFound();
        }
    }

    public function handleNotFound()
    {
        http_response_code(404);
        echo "404 - Not Found";
    }
}
