<?php

namespace App\Infrastructure\Router;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {

        $uri = parse_url($uri, PHP_URL_PATH);
        $methodRoutes = $this->routes[$method] ?? [];

        if (isset($methodRoutes[$uri])) {
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

            if (stripos($contentType, 'application/json') !== false) {
                $data = json_decode(file_get_contents('php://input'), true) ?? [];
            } else {
                $data = $_REQUEST;
            }

            echo json_encode(call_user_func($methodRoutes[$uri], $data));
            return;
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Route not found']);
        }
    }
}