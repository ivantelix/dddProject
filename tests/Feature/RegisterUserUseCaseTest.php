<?php

namespace Tests\Unit\Application\User\UseCase;

use App\Application\User\DTO\RegisterUserRequest;
use App\Application\User\UseCase\RegisterUserUseCase;
use App\Domain\User\Entity\User;
use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\WeakPasswordException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Exception\UserAlreadyExists;
use PHPUnit\Framework\TestCase;
use \App\Infrastructure\Event\EventDispatcher;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};

class RegisterUserUseCaseTest extends TestCase
{
    private UserRepositoryInterface $userRepositoryMock;
    private RegisterUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new RegisterUserUseCase(
            $this->userRepositoryMock,
            $this->createMock(EventDispatcher::class)
        );
    }

    public function testRegistersUserSuccessfully()
    {
        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Secure*123');
        $response = $this->useCase->execute($request);
        $this->assertEquals('john@example.com', $response->email);
    }

    public function testThrowsExceptionIfUserAlreadyExists()
    {
        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Secure*123');

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with(new Email('john@example.com'))
            ->willReturn(
                new User(
                    new UserId(1),
                    new Name('John Doe'),
                    new Email('john@example.com'),
                    new Password('Secure*123')
                )
            );

        $this->expectException(UserAlreadyExists::class);
        $this->useCase->execute($request);
    }

    public function testEmailIsValid()
    {
        $this->expectException(InvalidEmailException::class);
        $this->expectExceptionMessage('Invalid email');

        $request = new RegisterUserRequest('John Doe', 'john.com', 'Secure*123');
        $this->useCase->execute($request);
    }

    public function testWeekPassword()
    {
        $this->expectException(WeakPasswordException::class);
        $this->expectExceptionMessage('Password is too weak, please use a stronger password than password');

        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'password');
        $this->useCase->execute($request);
    }
}
