<?php

namespace Tests;

use Games\FizzBuzz;
use Games\OutOfRangeException;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase {

    public static function validInputs(): array {
        return [
            [1, "1"],
            [67, "67"],
            [82, "82"],
            [3, "Fizz"],
            [66, "Fizz"],
            [99, "Fizz"],
            [5, "Buzz"],
            [50, "Buzz"],
            [85, "Buzz"],
            [15, "FizzBuzz"],
            [30, "FizzBuzz"],
            [45, "FizzBuzz"],
        ];
    }

    public static function invalidInputs(): array {
        return [
            [0],
            [-1],
            [101],
        ];
    }

    /**
     * @dataProvider validInputs
     */
    public function testReturnsNumberRepresentation(int $input, string $expectedResult): void {
        $this->assertEquals($expectedResult, FizzBuzz::convert($input));
    }

    /**
     * @dataProvider invalidInputs
     */
    public function testThrowsExceptionForNumbersOutOfRange(int $input): void {
        $this->assertEquals('Input out of range', FizzBuzz::convert($input));
    }
}
