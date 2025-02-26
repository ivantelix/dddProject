<?php

namespace App\Domain\User\ValueObject;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email.");
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}