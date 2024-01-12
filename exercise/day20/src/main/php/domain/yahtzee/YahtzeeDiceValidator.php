<?php

namespace Domain\Yahtzee;

use function Functional\group;
use function Functional\sum;
use function iter\all;
use function iter\mkString;
use function iter\range;
use function iter\zip;

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
        return all($dice, fn($die) => $this->isValidDie($die));
    }

    private function isValidDie(int $die): bool
    {
        return $die >= self::MINIMUM_DIE && $die <= self::MAXIMUM_DIE;
    }
}