<?php

namespace Tests\Unit\Application\User\Unit;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};
use App\Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{

    public function testCreateValidUser()
    {
        $userId = new UserId('123456');
        $name = new Name('John Doe');
        $email = new Email('john.doe@example.com');
        $password = new Password('StrongP@ss123');
        $user = new User($userId, $name, $email, $password);

        $this->assertEquals('123456', $user->id()->value());
        $this->assertEquals('John Doe', $user->name()->value());
        $this->assertEquals('john.doe@example.com', $user->email()->value());
        $this->assertNotEmpty($user->password()->value());
    }

    public function testUserCreationWithInvalidEmailThrowsException()
    {
        $this->expectException(InvalidEmailException::class);
        $userId = new UserId('1234567');
        $name = new Name('John Doe');
        $email = new Email('invalidemail.com');
        $password = new Password('StrongP@ss123');
        new User($userId, $name, $email, $password);
    }

}