<?php

namespace Only\Test\Base;

class Router
{
    private array $routes = [];

    public function get(string $path, string $controller, string $action = null, array $middleware = []): Router
    {
        return $this->addRoute('GET', $path, $controller, $action, $middleware);
    }

    public function post(string $path, string $controller, string $action = null, array $middleware = []): Router
    {
        return $this->addRoute('POST', $path, $controller, $action, $middleware);
    }

    public function patch(string $path, string $controller, string $action = null, array $middleware = []): Router
    {
        return $this->addRoute('PATCH', $path, $controller, $action, $middleware);
    }

    public function delete(string $path, string $controller, string $action = null, array $middleware = []): Router
    {
        return $this->addRoute('DELETE', $path, $controller, $action, $middleware);
    }

    public function resolve(string $method, string $path, array $query): void
    {
        foreach ($this->routes as $route) {
            if ($route['path'] === $path &&
                $route['method'] === strtoupper($method)) {
                if ($route['method'] !== 'GET') {
                    $token = htmlspecialchars($_POST['_token']);
                    if (empty($token) || !hash_equals($_SESSION['_token'], $token)) {
                        abort(405);
                    }
                }

                foreach ($route['middleware'] as $middleware) {
                    (new $middleware)->handle();
                }

                $controller = new $route['controller'];
                call_user_func([$controller, $route['action']], $query);

                unset($_SESSION['_flash']);
                die;
            }
        }

        abort();
    }

    private function addRoute(string $method, string $path, string $controller, string $action, array $middleware): Router
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware
        ];

        return $this;
    }
}
