<?php

namespace App\Domain\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\ValueObject\{UserId, Name, Email, Password};

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string", unique: true)]
    private string $email;

    #[ORM\Column(type: "string")]
    private string $password;

    private \DateTimeImmutable $createdAt;

    public function __construct(UserId $id, Name $name, Email $email, Password $password)
    {
        $this->id = (int)$id->value();
        $this->name = $name->value();
        $this->email = $email->value();
        $this->password = $password->value();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function id(): UserId
    {
        return new UserId($this->id);
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function email(): Email
    {
        return new Email($this->email);
    }

    public function password(): Password
    {
        return new Password($this->password);
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}