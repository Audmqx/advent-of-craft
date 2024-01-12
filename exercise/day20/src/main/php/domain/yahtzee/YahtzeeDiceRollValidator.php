<?php

namespace Domain\Yahtzee;

use Innmind\Immutable\Either;
use stdClass;

class YahtzeeDiceRollValidator
{
    private const ROLL_LENGTH = 5;
    private const MINIMUM_DIE = 1;
    private const MAXIMUM_DIE = 6;

    public function validateRoll(array $dice): Either
    {
        if ($this->hasInvalidLength($dice)) {
            return Either::left("Invalid dice... A roll should contain 5 dice.");
        }

        if ($this->containsInvalidDie($dice)) {
            return Either::left("Invalid die value. Each die must be between 1 and 6.");
        }

        return Either::right(true); 
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
