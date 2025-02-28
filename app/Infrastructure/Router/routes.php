<?php

use App\Infrastructure\Router\Router;
use App\Infrastructure\Controller\RegisterUserController;
use App\Infrastructure\Controller\GetUserController;

$router = new Router();

$router->post('/register', function ($request) {
    $controller = new RegisterUserController();
    return $controller->handle($request);
});

$router->get('/user', function ($request) {
    if (!isset($_GET['id'])) {
        return json_encode(['status' => 'error', 'message' => 'Missing user ID']);
    }
    $controller = new GetUserController();
    return $controller->handle($_GET['id']);
});

return $router;