<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Bootstrap;
use App\Infrastructure\Exceptions\ExceptionHandler;

try {
    $router = Bootstrap::init();
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (\Throwable $e) {
    ExceptionHandler::handle($e);
}
