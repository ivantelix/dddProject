<?php

namespace App\Domain\User\Exception;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct(string $email)
    {
        $message = "Invalid email: $email please use a valid email address";
        parent::__construct($message);
    }
}