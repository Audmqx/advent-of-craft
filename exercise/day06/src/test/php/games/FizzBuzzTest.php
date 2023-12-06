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

    public function test_game_shuld_return_inputs(): void
    {
        $this->assertEquals("1", FizzBuzz::convert(1));
    }
    public function testReturnsTheGivenNumberFor1(): void
    {
        $this->assertEquals("1", FizzBuzz::convert(1));
    }

    public function testReturnsTheGivenNumberFor67(): void
    {
        $this->assertEquals("67", FizzBuzz::convert(67));
    }

    public function testReturnsTheGivenNumberFor82(): void
    {
        $this->assertEquals("82", FizzBuzz::convert(82));
    }


    public function testReturnsFizzBuzzFor15(): void
    {
        $this->assertEquals("FizzBuzz", FizzBuzz::convert(15));
    }

    public function testReturnsFizzBuzzFor30(): void
    {
        $this->assertEquals("FizzBuzz", FizzBuzz::convert(30));
    }

    public function testReturnsFizzBuzzFor45(): void
    {
        $this->assertEquals("FizzBuzz", FizzBuzz::convert(45));
    }

    public function testThrowsAnExceptionFor0(): void
    {
        $this->expectException(OutOfRangeException::class);
        FizzBuzz::convert(0);
    }

    public function testThrowsAnExceptionFor101(): void
    {
        $this->expectException(OutOfRangeException::class);
        FizzBuzz::convert(101);
    }

    public function testThrowsAnExceptionForMinus1(): void
    {
        $this->expectException(OutOfRangeException::class);
        FizzBuzz::convert(-1);
    }
}
