<?php

namespace Tests;

use People\Person;
use People\Pet;
use People\PetType;
use People\Population;
use PHPUnit\Framework\TestCase;

class PopulationTest extends TestCase
{
    private Population $population;

    public function setUp(): void
    {
        $peter = new Person("Peter", "Griffin");
        $peter->addPet(new Pet(PetType::CAT, "Tabby", 2));

        $stewie = new Person("Stewie", "Griffin");
        $stewie->addPet(new Pet(PetType::CAT, "Dolly", 3));
        $stewie->addPet(new Pet(PetType::DOG, "Brian", 9));

        $joe = new Person("Joe", "Swanson");
        $joe->addPet(new Pet(PetType::DOG, "Spike", 4));

        $lois = new Person("Lois", "Griffin");
        $lois->addPet(new Pet(PetType::SNAKE, "Serpy", 1));

        $this->population = new Population();
        $this->population->addPerson($peter);
        $this->population->addPerson($stewie);
        $this->population->addPerson($joe);
        $this->population->addPerson($lois);
    }

    public function testWhoOwnsTheYoungestPet(): void
    {
        $lois = $this->population->findWhoOwnsTheYoungestPet();

        $this->assertNotNull($lois);
        $this->assertSame($lois->firstName, 'Lois');
    }
}
