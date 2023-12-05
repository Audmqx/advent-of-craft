<?php

namespace People;

use People\Pet;
use People\PetType;

class Person
{
    private $firstName;
    private $lastName;
    private $pets;

    public function __construct(string $firstName, string $lastName, array $pets = [])
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->pets = $pets;
    }

    public function addPet(string $petType, string $name, int $age): self
    {
        $this->pets[] = new Pet($petType, $name, $age);
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPets(): array
    {
        return $this->pets;
    }
}
