<?php

use PHPUnit\Framework\TestCase;

use People\Person;
use People\Pet;
use People\PetType;

class PopulationTest extends TestCase
{
    private static $population;

    public static function setUpBeforeClass(): void
    {
        self::$population = [
            (new Person("Peter", "Griffin"))
                ->addPet(PetType::CAT, "Tabby", 2),
            (new Person("Stewie", "Griffin"))
                ->addPet(PetType::CAT, "Dolly", 3)
                ->addPet(PetType::DOG, "Brian", 9),
            (new Person("Joe", "Swanson"))
                ->addPet(PetType::DOG, "Spike", 4),
            (new Person("Lois", "Griffin"))
                ->addPet(PetType::SNAKE, "Serpy", 1),
            (new Person("Meg", "Griffin"))
                ->addPet(PetType::BIRD, "Tweety", 1),
            (new Person("Chris", "Griffin"))
                ->addPet(PetType::TURTLE, "Speedy", 4),
            (new Person("Cleveland", "Brown"))
                ->addPet(PetType::HAMSTER, "Fuzzy", 1)
                ->addPet(PetType::HAMSTER, "Wuzzy", 2),
            (new Person("Glenn", "Quagmire")),
        ];
    }

    public function testPeopleWithTheirPets()
    {
        $response = $this->formatPopulation();

        $expectedResponse = "Peter Griffin who owns : Tabby\n" .
            "Stewie Griffin who owns : Dolly Brian\n" .
            "Joe Swanson who owns : Spike\n" .
            "Lois Griffin who owns : Serpy\n" .
            "Meg Griffin who owns : Tweety\n" .
            "Chris Griffin who owns : Speedy\n" .
            "Cleveland Brown who owns : Fuzzy Wuzzy\n" .
            "Glenn Quagmire";

        var_dump($expectedResponse);
        var_dump($response);

        $this->assertEquals($expectedResponse, $response);
    }

    private function formatPopulation()
    {
        $resultArray = array_map(function ($person) {
            $petNames = array_map(fn ($pet) => $pet->getName(), $person->getPets());
            $petString = !empty($petNames) ? " who owns : " . implode(' ', $petNames) : '';

            return $person->getFirstName() . ' ' . $person->getLastName() . $petString;
        }, self::$population);

        $response = implode("\n", $resultArray);

        return $response;
    }

    public function testWhoOwnsTheYoungestPet()
    {
        $filtered = min(self::$population, function ($a, $b) {
            return $this->youngestPetAgeOfThePerson($a) <=> $this->youngestPetAgeOfThePerson($b);
        });

        $this->assertSame("Lois", $filtered->getFirstName());
    }

    private function youngestPetAgeOfThePerson($person)
    {
        return min(array_map(function ($pet) {
            return $pet->getAge();
        }, $person->getPets()), PHP_INT_MAX);
    }
}
