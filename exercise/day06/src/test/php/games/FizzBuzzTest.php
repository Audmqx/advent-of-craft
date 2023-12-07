<?php

namespace Games\Tests;

use Games\FizzBuzz;
use Games\OutOfRangeException;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{

    public static function divisibleByThreeDataProvider(): array
    {
        return [
            [3],
            [66],
            [99],
        ];
    }

    /**
     * @dataProvider divisibleByThreeDataProvider
     */
    public function test_game_shuld_return_fizz(int $input): void
    {
        $this->assertEquals("Fizz", FizzBuzz::convert($input));
    }

    public static function divisibleByFiveDataProvider(): array
    {
        return [
            [5],
            [50],
            [85],
        ];
    }

    /**
     * @dataProvider divisibleByFiveDataProvider
     */
    public function test_game_shuld_return_buzz(int $input): void
    {
        $this->assertEquals("Buzz", FizzBuzz::convert($input));
    }

    public static function notDivisibleByThreeOrFiveDataProvider(): array
    {
        return [
            [1],
            [67],
            [82],
        ];
    }

    /**
     * @dataProvider notDivisibleByThreeOrFiveDataProvider
     */
    public function test_game_shuld_return_inputs(int $input): void
    {
        $this->assertEquals($input, FizzBuzz::convert($input));
    }

    public static function divisibleByFiveAndThreeDataProvider(): array
    {
        return [
            [15],
            [30],
            [45],
        ];
    }

    /**
     * @dataProvider divisibleByFiveAndThreeDataProvider
     */
    public function test_game_shuld_return_FizzBuzz(int $input): void
    {
        $this->assertEquals("FizzBuzz", FizzBuzz::convert($input));
    }

    public static function outOfRangeDataProvider(): array
    {
        return [
            [0],
            [101],
            [-1],
        ];
    }

    /**
     * @dataProvider outOfRangeDataProvider
     */
    public function test_game_shuld_return_an_exception(int $input): void
    {
        $this->expectException(OutOfRangeException::class);
        FizzBuzz::convert($input);
    }
}
