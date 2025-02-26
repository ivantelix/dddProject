<?php

namespace App\Domain\User\ValueObject;

class UserId
{
    private string $id;

    public function __construct(string $id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException("User ID cannot be empty.");
        }
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
    
}