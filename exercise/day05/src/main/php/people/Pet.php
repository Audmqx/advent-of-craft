<?php

namespace People;

use People\PetType;

class Pet
{
    private $type;
    private $name;
    private $age;

    public function __construct($type, string $name, int $age)
    {
        $this->type = $type;
        $this->name = $name;
        $this->age = $age;
    }

    public function getType(): PetType
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}