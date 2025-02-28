<?php

namespace Tests\Unit\Application\User\Unit;

use App\Application\User\EventHandler\SendWelcomeEmailHandler;
use App\Application\User\UseCase\RegisterUserUseCase;
use App\Domain\User\Entity\User;
use App\Domain\User\Event\UserRegisteredEvent;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};
use App\Infrastructure\Event\EventDispatcher;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    private $userRepositoryMock;
    private $eventDispatcherMock;
    private $useCase;

    protected function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $this->eventDispatcherMock = $this->createMock(EventDispatcher::class);
        $this->useCase = new RegisterUserUseCase($this->userRepositoryMock, $this->eventDispatcherMock);
    }

    public function testDispatchSendWelcomeEmailEvent()
    {
        $user = new User(
            new UserId('123'),
            new Name('John Doe'),
            new Email('john@example.com'),
            new Password('Secure*123')
        );

        $event = new UserRegisteredEvent($user);
        $handler = new SendWelcomeEmailHandler();

        ob_start();
        $handler($event);
        $output = ob_get_clean();

        $this->assertStringContainsString("Welcome email sent to " . $user->email()->value() . PHP_EOL, $output);
    }


}