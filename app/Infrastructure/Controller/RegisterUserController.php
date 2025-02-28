<?php

namespace App\Infrastructure\Controller;

use App\Application\User\UseCase\RegisterUserUseCase;
use App\Application\User\DTO\RegisterUserRequest;
use App\Infrastructure\DependencyContainer;

class RegisterUserController
{
    public function handle($requestData): string
    {
        $request = new RegisterUserRequest(
            $requestData['name'] ?? '',
            $requestData['email'] ?? '',
            $requestData['password'] ?? ''
        );

        try {
            $registerUserUseCase = DependencyContainer::get(RegisterUserUseCase::class);
            $response = $registerUserUseCase->execute($request);
            return json_encode([
                'status' => 'success',
                'data' => $response
            ]);
        } catch (\App\Domain\User\Exception\UserAlreadyExists|\Exception $e) {
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
