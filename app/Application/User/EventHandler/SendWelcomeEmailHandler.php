<?php

namespace App\Application\User\EventHandler;

use App\Domain\User\Event\UserRegisteredEvent;

class SendWelcomeEmailHandler
{
    public function __invoke(UserRegisteredEvent $event): void
    {
        echo "Welcome email sent to " . $event->getUser()->email()->value() . PHP_EOL;
    }
}