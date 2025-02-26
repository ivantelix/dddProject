<?php

namespace App\Application\User\UseCase;

use App\Application\User\DTO\{RegisterUserRequest, UserResponseDTO};
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Event\UserRegisteredEvent;
use App\Infrastructure\Event\EventDispatcher;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository, EventDispatcher $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        if ($this->userRepository->findById(new UserId($request->email))) {
            throw new \Exception("User already exists.");
        }

        $user = new User(
            new UserId(uniqid()),
            new Name($request->name),
            new Email($request->email),
            new Password($request->password)
        );

        $this->userRepository->save($user);

        $this->eventDispatcher->dispatch(new UserRegisteredEvent($user));

        return new UserResponseDTO(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->createdAt()->format('Y-m-d H:i:s')
        );
    }
}