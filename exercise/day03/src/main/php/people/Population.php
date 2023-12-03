<?php

namespace People;

class Population
{
    public function __construct(
        public  array $persons = [])
    {}

    public function addPerson(Person $person): void
    {
        $this->persons[] = $person;
    }

    public function findWhoOwnsTheYoungestPet(): Person|null
    {
        $youngestOwner = null;
        $youngestAge = PHP_INT_MAX;

        foreach ($this->persons as $person) {
            foreach ($person->pets as $pet) {
                if ($pet->age < $youngestAge) {
                    $youngestOwner = $person;
                }
            }
        }

        return $youngestOwner;
    }
}