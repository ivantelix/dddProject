<?php

namespace App\Application\User\DTO;

class RegisterUserRequest
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        $this->validate();
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException("The name field is required.");
        }

        if (empty($this->email)) {
            throw new \InvalidArgumentException("The email field is required.");
        }

        if (empty($this->password)) {
            throw new \InvalidArgumentException("The password field is required.");
        }
    }
}