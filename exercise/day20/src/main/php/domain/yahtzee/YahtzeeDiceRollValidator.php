<?php

namespace Domain\Yahtzee;

class YahtzeeRollValidator
{
    private const ROLL_LENGTH = 5;
    private const MINIMUM_DIE = 1;
    private const MAXIMUM_DIE = 6;

    public function __construct(private array $dice)
    {
        $this->validateRoll($dice);
    }

    public function validateRoll(array $dice): string|bool
    {
        if ($this->hasInvalidLength($dice)) {
            return "Invalid dice... A roll should contain 5 dice.";
        }

        if ($this->containsInvalidDie($dice)) {
            return "Invalid die value. Each die must be between 1 and 6.";
        }

        return false; 
    }

    private function hasInvalidLength(array $dice): bool
    {
        return $dice === null || count($dice) !== self::ROLL_LENGTH;
    }

    private function containsInvalidDie(array $dice): bool
    {
        foreach ($dice as $die) {
            if (!$this->isValidDie($die)) {
                return true;
            }
        }

        return false;
    }

    private function isValidDie(int $die): bool
    {
        return $die >= self::MINIMUM_DIE && $die <= self::MAXIMUM_DIE;
    }
}
