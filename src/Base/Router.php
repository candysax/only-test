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

    public function patch(string $path, string $controller, string $action = null): Router
    {
        return $this->addRoute('PATCH', $path, $controller, $action);
    }

    public function delete(string $path, string $controller, string $action = null): Router
    {
        return $this->addRoute('DELETE', $path, $controller, $action);
    }

    public function resolve(string $method, string $path, array $query): void
    {
        foreach ($this->routes as $route) {
            if ($route['path'] === $path &&
                $route['method'] === strtoupper($method)) {
                $controller = new $route['controller'];
                call_user_func([$controller, $route['action']], $query);

                unset($_SESSION['_flash']);
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
