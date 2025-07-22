<?php

namespace App\Dto;

class UserCreateDto {

    private string $name;
    private string $email;

    public function __construct(string $name, string $email) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Nome obrigatório');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email inválido');
        }
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }
}