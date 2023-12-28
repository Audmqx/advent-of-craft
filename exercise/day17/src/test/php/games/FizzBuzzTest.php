<?php

namespace Tests\Games;

use Games\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * @return array
     */
    public static function validInputsProvider()
    {
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

    /**
     * @return array
     */
    public static function invalidInputsProvider()
    {
        return [
            [0],
            [-1],
            [101],
        ];
    }

    /**
     * @dataProvider validInputsProvider
     *
     * @param int $input
     * @param string $expectedResult
     */
    public function testConvertSuccessfullyNumbersBetween1And100(int $input, string $expectedResult)
    {
        $this->assertEquals(FizzBuzz::convert($input)->get(), $expectedResult);
    }

    /**
     * @dataProvider invalidInputsProvider
     *
     * @param int $input
     */
    public function testConvertFailsForNumbersOutOfRange(int $input)
    {
        $this->assertTrue(FizzBuzz::convert($input)->isEmpty());
    }
}
