<?php

use App\Infrastructure\Router\Router;

$router = new Router();

$router->post('/register', 'RegisterUserController@handle');
$router->get('/user', 'GetUserController@handle');

return $router;