<?php

namespace App\Infrastructure;

use App\Infrastructure\Router\Router;
use App\Application\User\UseCase\RegisterUserUseCase;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Infrastructure\Event\EventDispatcher;
use App\Application\User\EventHandler\SendWelcomeEmailHandler;

class Bootstrap
{
    public static function init(): Router
    {
        $entityManager = require __DIR__ . '/../../config/doctrine.php';
        $userRepository = new DoctrineUserRepository($entityManager);
        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->listen(\App\Domain\User\Event\UserRegisteredEvent::class, new SendWelcomeEmailHandler());

        // Registrar dependencias
        DependencyContainer::set(DoctrineUserRepository::class, $userRepository);
        DependencyContainer::set(EventDispatcher::class, $eventDispatcher);
        DependencyContainer::set(RegisterUserUseCase::class, new RegisterUserUseCase($userRepository, $eventDispatcher));

        return require __DIR__ . '/Router/routes.php';
    }
}