<?php

namespace Games;

class FizzBuzz {
    public const MIN = 0;
    public const MAX = 100;
    public const FIZZ = 3;
    public const BUZZ = 5;
    public const FIZZBUZZ = 15;

    public function __construct() {}

    public function convert(int $input): string
    {
        $this->throwExceptionIfIsOutOfRange($input);

        return $this->convertSafely($input);
    }

    private function convertSafely(int $input): string {
         return match (true) {
             $this->is($this::FIZZBUZZ, $input) => "FizzBuzz",
             $this->is($this::FIZZ, $input)  => "Fizz",
             $this->is($this::BUZZ, $input)  => "Buzz",
             default => $input,
        };
    }

    private function is(int $divisor, int $input): bool {
        return $input % $divisor === 0;
    }

    private function throwExceptionIfIsOutOfRange(int $input): bool|Exception
    {
        return $input <= $this::MIN || $input > $this::MAX ? throw new OutOfRangeException() : false;
    }
}
