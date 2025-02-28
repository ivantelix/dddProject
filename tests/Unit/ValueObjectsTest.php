<?php

namespace Tests\Unit\Application\User\Unit;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\WeakPasswordException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};

class ValueObjectsTest extends TestCase
{
    public function testValidUserId()
    {
        $userId = new UserId('123e4567-e89b-12d3-a456-426614174000');
        $this->assertEquals('123e4567-e89b-12d3-a456-426614174000', $userId->value());
    }

    public function testEmptyUserIdThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new UserId('');
    }

    public function testEmail()
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->value());
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalidemail.com');
    }

    public function testName()
    {
        $name = new Name('John Doe');
        $this->assertEquals('John Doe', $name->value());
    }

    public function testInvalidName()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('qweqwe---');
    }

    public function testValidPassword()
    {
        $password = new Password('StrongP@ss123');
        $this->assertNotEmpty($password->value());
    }

    public function testWeakPasswordThrowsException()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('weak');
    }

}