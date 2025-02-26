<?php

namespace App\Domain\User\ValueObject;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) < 3 || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \InvalidArgumentException("Invalid name.");
        }
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}