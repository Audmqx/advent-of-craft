<?php

namespace Games;

use PhpOption\Option;
use PhpOption\None;
use PhpOption\Some;

class FizzBuzz {
    public const MIN = 1;
    public const MAX = 100;
    private const MAPPING = [
        15 => "FizzBuzz",
        3 => "Fizz",
        5 => "Buzz",
    ];

    public static function convert(int $input): Option {
        return self::isOutOfRange($input)
            ? None::create()
            : Some::create(self::convertSafely($input));
    }

    private static function convertSafely(int $input): string {
        $result = '';

        foreach (self::MAPPING as $divisor => $value) {
            if (self::is($divisor, $input)) {
                $result .= $value;
            }
        }

        if (self::is(15, $input)) {
            $result = 'FizzBuzz';
        }

        return $result !== '' ? $result : (string)$input;
    }


    private static function is(int $divisor, int $input): bool {
        return $input % $divisor === 0;
    }

    private static function isOutOfRange(int $input): bool {
        return $input < self::MIN || $input > self::MAX;
    }
}
