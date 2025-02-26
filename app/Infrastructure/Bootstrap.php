<?php

namespace App\Infrastructure;

use App\Infrastructure\Router\Router;

class Bootstrap
{
    public static function init(): Router
    {
        return require __DIR__ . '/Router/routes.php';
    }
}