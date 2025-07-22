<?php
namespace App\Entities;

use Ramsey\Uuid\Uuid;

class User{

    private string $id;
    private string $name;
    private string $email;

    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->email = $email;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}