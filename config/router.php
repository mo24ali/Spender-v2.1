<?php



    class Router{
        public array $routes = [];

        public function get(string $method, callable $handler){



            $this->routes[$method] = $handler;
        }
        public function post(string $method, callable $handler){

        }

        public function resolve(){




        }
    }