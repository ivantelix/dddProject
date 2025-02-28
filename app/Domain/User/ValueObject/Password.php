<?php

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\WeakPasswordException;

class Password
{
    private string $hashedPassword;

    public function __construct(string $password)
    {
        if (!$this->isValid($password)) {
            throw new WeakPasswordException($password);
        }
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    private function isValid(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/', $password);
    }

    public function value(): string
    {
        return $this->hashedPassword;
    }
}