<?php

namespace Games;

use Games\OutOfRangeException;

class FizzBuzz
{

    public function play(int $input): string|OutOfRangeException
    {
        $this->validateFizzBuzzNumber($input);

        if ($this->isFizzBuzzNumber($input)) {
            return "FizzBuzz";
        }

        if ($this->isFizzNumber($input)) {
            return "Fizz";
        }

        if ($this->isBuzzNumber($input)) {
            return "Buzz";
        }

        return strval($input);
    }

    private function validateFizzBuzzNumber(int $input): void
    {
        if ($input <= 0 || $input > 100) {
            throw new OutOfRangeException();
        }
    }

    private function isFizzBuzzNumber(int $input): bool
    {
        return $input % 3 == 0 && $input % 5 == 0;
    }

    private function isFizzNumber(int $input): bool
    {
        return $input % 3 == 0;
    }

    private function isBuzzNumber(int $input): bool
    {
        return $input % 5 == 0;
    }
}