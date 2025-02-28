<?php

namespace App\Domain\User\Exception;

class WeakPasswordException extends \Exception
{
    public function __construct(string $password)
    {
        $message = "Password is too weak, please use a stronger password than $password";
        parent::__construct($message);
    }
}