<?php

namespace Tests\Games;

use Games\FizzBuzz;
use PHPUnit\Framework\TestCase;
use Eris\Generators;

class FizzBuzzTest extends TestCase
{
    use \Eris\TestTrait;

    public function test_out_of_range_numbers()
    {
        $this->forAll(
            Generators::choose(-100, 200)
        )
            ->when( function ($number) {
                return $number <= 0 || $number > 100;
            })
            ->then(function ($number) {
                $this->assertTrue(FizzBuzz::convert($number)->isEmpty());
            });
    }

    public function test_fizz_Buzz_numbers()
    {
        $this->forAll(
            Generators::choose(1, 100)
        )
            ->then(function ($number) {
                $result = FizzBuzz::convert($number)->get();

                if ($number % 3 === 0 && $number % 5 === 0) {
                    $this->assertEquals('FizzBuzz', $result);
                } elseif ($number % 3 === 0) {
                    $this->assertEquals('Fizz', $result);
                } elseif ($number % 5 === 0) {
                    $this->assertEquals('Buzz', $result);
                }
            });
    }
}
