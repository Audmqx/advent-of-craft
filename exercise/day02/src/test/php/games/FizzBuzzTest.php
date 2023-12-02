<?php

use Games\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    private $fizzBuzz;

    public function setUp(): void
    {
        $this->fizzBuzz = new FizzBuzz();
    }

    public function test_returns_the_given_number_for_1(): void
    {
        $this->assertEquals("1", $this->fizzBuzz->play(1));
    }

    public function test_returns_the_given_number_for_67(): void
    {
        $this->assertEquals("67", $this->fizzBuzz->play(67));
    }

    public function test_returns_the_given_number_for_82(): void
    {
        $this->assertEquals("82", $this->fizzBuzz->play(82));
    }

    public function test_returns_Fizz_for_3(): void
    {
        $this->assertEquals("Fizz", $this->fizzBuzz->play(3));
    }

    public function test_returns_Fizz_for_66(): void
    {
        $this->assertEquals("Fizz", $this->fizzBuzz->play(66));
    }

    public function test_returns_Fizz_for_99(): void
    {
        $this->assertEquals("Fizz", $this->fizzBuzz->play(99));
    }

    public function test_returns_Buzz_for_5(): void
    {
        $this->assertEquals("Buzz", $this->fizzBuzz->play(5));
    }

    public function test_returns_Buzz_for_50(): void
    {
        $this->assertEquals("Buzz", $this->fizzBuzz->play(50));
    }

    public function test_returns_Buzz_for_85(): void
    {
        $this->assertEquals("Buzz", $this->fizzBuzz->play(85));
    }

    public function test_returns_FizzBuzz_for_15(): void
    {
        $this->assertEquals("FizzBuzz", $this->fizzBuzz->play(15));
    }

    public function test_returns_FizzBuzz_for_30(): void
    {
        $this->assertEquals("FizzBuzz", $this->fizzBuzz->play(30));
    }

    public function test_returns_FizzBuzz_for_45(): void
    {
        $this->assertEquals("FizzBuzz", $this->fizzBuzz->play(45));
    }

    public function test_throws_an_exception_for_0(): void
    {
        $this->expectException(\Games\OutOfRangeException::class);
        $this->fizzBuzz->play(0);
    }

    public function test_throws_an_exception_for_101(): void
    {
        $this->expectException(\Games\OutOfRangeException::class);
        $this->fizzBuzz->play(101);
    }

    public function test_throws_an_exception_for_minus_1(): void
    {
        $this->expectException(\Games\OutOfRangeException::class);
        $this->fizzBuzz->play(-1);
    }
}
