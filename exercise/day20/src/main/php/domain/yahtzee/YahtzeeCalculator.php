<?php

namespace Domain\Yahtzee;

use function Functional\group;
use function Functional\sum;
use function iter\all;
use function iter\mkString;
use function iter\range;
use function iter\zip;

class YahtzeeCalculator
{
    private const ROLL_LENGTH = 5;
    private const MINIMUM_DIE = 1;
    private const MAXIMUM_DIE = 6;

    private function validateRoll(array $dice): void
    {
        if ($this->hasInvalidLength($dice)) {
            throw new \InvalidArgumentException("Invalid dice... A roll should contain 6 dice.");
        }

        if ($this->containsInvalidDie($dice)) {
            throw new \InvalidArgumentException("Invalid die value. Each die must be between 1 and 6.");
        }
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
        return $die < self::MINIMUM_DIE || $die > self::MAXIMUM_DIE;
    }

    public function number(array $dice, int $number): int
    {
        return $this->calculate(
            fn($d) => sum(array_filter($d, fn($die) => $die === $number)),
            $dice
        );
    }

    public function threeOfAKind(array $dice): int
    {
        return $this->calculateNOfAKind($dice, 3);
    }

    public function fourOfAKind(array $dice): int
    {
        return $this->calculateNOfAKind($dice, 4);
    }

    public function yahtzee(array $dice): int
    {
        return $this->calculate(
            fn($d) => $this->hasNOfAKind($d, 5) ? Scores::YAHTZEE_SCORE : 0,
            $dice
        );
    }

    private function calculateNOfAKind(array $dice, int $n): int
    {
        return $this->calculate(
            fn($d) => $this->hasNOfAKind($d, $n) ? array_sum($d) : 0,
            $dice
        );
    }

    public function fullHouse(array $dice): int
    {
        return $this->calculate(
            fn($d) => $this->isFullHouse($d) ? Scores::HOUSE_SCORE : 0,
            $dice
        );
    }

    public function largeStraight(array $dice): int
    {
        return $this->calculate(
            fn($d) => $this->isLargeStraight($d) ? Scores::LARGE_STRAIGHT_SCORE : 0,
            $dice
        );
    }

    public function smallStraight(array $dice): int
    {
        return $this->calculate(
            fn($d) => $this->isSmallStraight($d) ? 30 : 0,
            $dice
        );
    }

    private function isFullHouse(array $dice): bool
    {
        $dieFrequency = $this->groupDieByFrequency($dice);
        return $dieFrequency->containsValue(3) && $dieFrequency->containsValue(2);
    }

    private function isLargeStraight(array $dice): bool
    {
        return all(
            zip($dice, range(2)),
            fn($pair) => $pair[0] + 1 === $pair[1]
        );
    }

    private function isSmallStraight(array $dice): bool
    {
        $diceString = $this->toSortedString($dice);
        return strpos($diceString, '1234') !== false || strpos($diceString, '2345') !== false || strpos($diceString, '3456') !== false;
    }

    private function hasNOfAKind(array $dice, int $n): bool
    {
        return $this->groupDieByFrequency($dice)
            ->values()
            ->any(fn($count) => $count >= $n);
    }

    private function toSortedString(array $dice): string
    {
        return mkString(array_unique($dice));
    }

    public function chance(array $dice): int
    {
        return $this->calculate(
            fn($d) => array_sum($d),
            $dice
        );
    }

    private function groupDieByFrequency(array $dice): array
    {
        return group($dice);
    }

    private function calculate(callable $compute, array $dice): int
    {
        $this->validateRoll($dice);
        return $compute($dice);
    }
}

class Scores
{
    public const YAHTZEE_SCORE = 50;
    public const HOUSE_SCORE = 25;
    public const LARGE_STRAIGHT_SCORE = 40;
}
