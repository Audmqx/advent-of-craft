<?php

namespace Games;

class FizzBuzz {
    public const MIN = 0;
    public const MAX = 100;
    public const FIZZ = 3;
    public const BUZZ = 5;
    public const FIZZBUZZ = 15;

    public function __construct() {}

    public function convert(int $input): string {
        if ($this->isOutOfRange($input)) {
            throw new OutOfRangeException();
        }
        return $this->convertSafely($input);
    }

    private function convertSafely(int $input): string {
        if ($this->is($this::FIZZBUZZ, $input)) {
            return "FizzBuzz";
        }
        if ($this->is($this::FIZZ, $input)) {
            return "Fizz";
        }
        if ($this->is($this::BUZZ, $input)) {
            return "Buzz";
        }
        return (string)$input;
    }

    private function is(int $divisor, int $input): bool {
        return $input % $divisor === 0;
    }

    private function isOutOfRange(int $input): bool {
        return $input <= $this::MIN || $input > $this::MAX;
    }
}