<?php

namespace App\Domain\User\Exception;

use Exception;

class UserAlreadyExists extends Exception
{
    public function __construct(string $email)
    {
        $message = "User with email '{$email}' already exists.";
        parent::__construct($message);
    }
}
