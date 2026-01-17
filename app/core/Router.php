<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, $handler)
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, $handler)
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    private function normalize(string $path): string
    {
        return '/' . trim($path, '/');
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove base directory (/public)
        $base = dirname($_SERVER['SCRIPT_NAME']);
        if ($base !== '/' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }

        $path = $this->normalize($uri ?: '/');

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            $this->handleNotFound();
            return;
        }

        if (is_array($handler)) {
            [$class, $method] = $handler;

            if (!class_exists($class)) {
                die("Controller $class not found");
            }

            $controller = new $class();

            if (!method_exists($controller, $method)) {
                die("Method $method not found in $class");
            }

            call_user_func([$controller, $method]);
            return;
        }

        call_user_func($handler);
    }

    private function handleNotFound()
    {
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
