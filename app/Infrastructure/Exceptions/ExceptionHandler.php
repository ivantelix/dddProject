<?php

namespace App\Infrastructure\Exceptions;

class ExceptionHandler
{
    public static function handle(\Throwable $exception): void
    {
        http_response_code(self::getStatusCode($exception));

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $exception->getMessage()
        ]);
        exit();
    }

    private static function getStatusCode(\Throwable $exception): int
    {
        return match (true) {
            $exception instanceof \InvalidArgumentException => 400,
            $exception instanceof \DomainException => 422,
            default => 500
        };
    }
}