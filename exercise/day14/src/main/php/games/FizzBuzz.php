<?php

namespace Games;

use Games\OutOfRangeException;
use Utils\Maybe;

class FizzBuzz {
    public const MIN = 0;
    public const MAX = 100;
    public const FIZZ = 3;
    public const BUZZ = 5;
    public const FIZZBUZZ = 15;

    private static $mapping = array();  // Utilisation de array() au lieu de []

    static function initMapping() {
        self::$mapping = array(
            function ($i) {
                return self::is(self::FIZZBUZZ, $i) ? "FizzBuzz" : null;
            },
            function ($i) {
                return self::is(self::FIZZ, $i) ? "Fizz" : null;
            },
            function ($i) {
                return self::is(self::BUZZ, $i) ? "Buzz" : null;
            },
        );
    }

    private static function is(int $divisor, int $input): bool {
        return $input % $divisor === 0;
    }

    private static function isOutOfRange(int $input): bool {
        return $input <= self::MIN || $input > self::MAX;
    }

    public static function convert(int $input): string {
        $input = self::isOutOfRange($input) ? false : $input;
        $mayBeInput = Maybe::just($input);

        return $mayBeInput
            ->map(fn($input) => self::convertSafely($input))
            ->getOrElse("Input out of range");
    }

    private static function convertSafely(int $input): string {
        self::initMapping();
        foreach (self::$mapping as $predicate) {
            $result = $predicate($input);
            if ($result !== null) {
                return $result;
            }
        }
        return (string) $input;
    }
}

?>
