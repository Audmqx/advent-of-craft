<?php

namespace People;

class Person {

    public function __construct(
        public string $firstName,
        public  string $lastName,
        public  array $pets = [])
    {}

    public function addPet(Pet $pet): self {
        $this->pets[] = $pet;
        return $this;
    }
}
