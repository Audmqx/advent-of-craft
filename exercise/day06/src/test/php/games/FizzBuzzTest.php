<?php

namespace Games\Tests;

use Games\FizzBuzz;
use Games\OutOfRangeException;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{

    public static function divisibleBy3DataProvider(): array
    {
        return [
            [3],
            [66],
            [99],
        ];
    }

    /**
     * @dataProvider divisibleBy3DataProvider
     */
    public function test_game_shuld_return_fizz(int $input): void
    {
        $this->assertEquals("Fizz", FizzBuzz::convert($input));
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


    public function testReturnsBuzzFor5(): void
    {
        $this->assertEquals("Buzz", FizzBuzz::convert(5));
    }

    public function testReturnsBuzzFor50(): void
    {
        $this->assertEquals("Buzz", FizzBuzz::convert(50));
    }

    public function testReturnsBuzzFor85(): void
    {
        $this->assertEquals("Buzz", FizzBuzz::convert(85));
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
