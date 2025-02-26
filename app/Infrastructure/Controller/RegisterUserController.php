<?php

namespace App\Infrastructure\Controller;

use App\Application\User\UseCase\RegisterUserUseCase;
use App\Application\User\DTO\RegisterUserRequest;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;
 
    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function __invoke(array $requestData): string
    {
        return "holasmund";
        $request = new RegisterUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        try {
            $response = $this->registerUserUseCase->execute($request);
            return json_encode([
                'status' => 'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function test(): string
    {
        return 'test';
    }
}
