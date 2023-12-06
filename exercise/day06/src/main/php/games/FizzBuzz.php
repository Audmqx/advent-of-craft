<?php

namespace Games;

class FizzBuzz
{
    private const MIN = 0;
    private const MAX = 100;
    private const FIZZ = 3;
    private const BUZZ = 5;
    private const FIZZBUZZ = 15;

    private function __construct()
    {
    }

    public static function convert(int $input): string
    {
        if (self::isOutOfRange($input)) {
            throw new OutOfRangeException();
        }
        return self::convertSafely($input);
    }

    private static function convertSafely(int $input): string
    {
        if (self::is(self::FIZZBUZZ, $input)) {
            return "FizzBuzz";
        }
        if (self::is(self::FIZZ, $input)) {
            return "Fizz";
        }
        if (self::is(self::BUZZ, $input)) {
            return "Buzz";
        }
        return (string)$input;
    }

    private static function is(int $divisor, int $input): bool
    {
        return $input % $divisor == 0;
    }

    private static function isOutOfRange(int $input): bool
    {
        return $input <= self::MIN || $input > self::MAX;
    }
}
