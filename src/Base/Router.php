<?php

namespace Only\Test\Base;

class Router
{
    private array $routes = [];

    public function get(string $path, string $controller, string $action = null): Router
    {
        return $this->addRoute('GET', $path, $controller, $action);
    }

    public function post(string $path, string $controller, string $action = null): Router
    {
        return $this->addRoute('POST', $path, $controller, $action);
    }

    public function resolve(): void
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $query = $method === 'GET' ? $_GET : $_POST;
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $path = ($path !== '/')? rtrim($path, '/') : $path;

        foreach ($this->routes as $route) {
            if ($route['path'] === $path &&
                $route['method'] === strtoupper($method)) {
                $controller = new $route['controller'];
                call_user_func([$controller, $route['action']], $query);
                die;
            }
        }

        abort();
    }

    private function addRoute(string $method, string $path, string $controller, string $action): Router
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];

        return $this;
    }
}
