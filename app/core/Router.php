<?php

namespace App\Core;


class Router
{
    private array $routes = [];


    // lets pretend these are setters to the routes array so when use the 
    // resolve method we will actrually find the must be callable functions 
    // otherwise this code should return a 404 notfound status error
    public function get(string $path, callable $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);

        // Normalize slashes
        $scriptDir = str_replace('\\', '/', $scriptDir);
        $requestUri = str_replace('\\', '/', $requestUri);

        // 1. Try to strip the full script directory (e.g. /spender-v2/public)
        if ($scriptDir !== '/' && strpos($requestUri, $scriptDir) === 0) {
            $path = substr($requestUri, strlen($scriptDir));
        }
        // 2. Fallback: Try to strip the parent directory (e.g. /spender-v2)
        // This handles cases where .htaccess rewrites the root logic
        else {
            $parentDir = dirname($scriptDir);
            if ($parentDir !== '/' && $parentDir !== '.' && strpos($requestUri, $parentDir) === 0) {
                $path = substr($requestUri, strlen($parentDir));
            } else {
                $path = $requestUri;
            }
        }

        if ($path === '' || $path === false) {
            $path = '/';
        }

        // Ensure path starts with /
        if (substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler) {
            $handler();
        } else {
            $this->handleNotFound();
        }
    }

    private function handleNotFound()
    {
        http_response_code(404);
        echo "Yet to come, stay tuned for more improvement ;)";
    }
}