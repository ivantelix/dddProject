<?php

namespace App\Infrastructure\Router;

use ReflectionClass;
use ReflectionParameter;

class Router
{
    private array $routes = [];

    public function get(string $path, string $controllerMethod): void
    {
        $this->routes['GET'][$path] = $controllerMethod;
    }

    public function post(string $path, string $controllerMethod): void
    {
        $this->routes['POST'][$path] = $controllerMethod;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $methodRoutes = $this->routes[$method] ?? [];

        if (isset($methodRoutes[$uri])) {
            [$controller, $method] = explode('@', $methodRoutes[$uri]);
            $controllerClass = "App\\Infrastructure\\Controller\\$controller";
            
            if (!class_exists($controllerClass) || !method_exists($controllerClass, $method)) {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Invalid controller or method']);
                return;
            }
            
            $controllerInstance = $this->resolveDependencies($controllerClass);
            echo json_encode($controllerInstance->$method());
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Route not found']);
        }
    }

    private function resolveDependencies(string $className)
    {
        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className();
        }

        $dependencies = array_map(function (ReflectionParameter $param) {
            $type = $param->getType();
            return $type && !$type->isBuiltin() ? $this->resolveDependencies($type->getName()) : null;
        }, $constructor->getParameters());

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}