<?php

namespace games;

use PHPUnit\Framework\TestCase;
use Games\FizzBuzz;

class FizzBuzzTest extends TestCase {
    public static function validInputsDataProvider(): array {
        return [
            [1, '1'],
            [67, '67'],
            [82, '82'],
            [3, 'Fizz'],
            [66, 'Fizz'],
            [99, 'Fizz'],
            [5, 'Buzz'],
            [50, 'Buzz'],
            [85, 'Buzz'],
            [15, 'FizzBuzz'],
            [30, 'FizzBuzz'],
            [45, 'FizzBuzz'],
        ];
    }

    public static function invalidInputsDataProvider(): array {
        return [
            [0],
            [-1],
            [101],
        ];
    }

    /**
     * @dataProvider validInputsDataProvider
     */
    public function testConvertReturnsNumberRepresentation(int $input, string $expectedResult): void {
        $fizzBuzz = new FizzBuzz();
        $this->assertSame($expectedResult, $fizzBuzz->convert($input));
    }

    /**
     * @dataProvider invalidInputsDataProvider
     */
    public function testConvertThrowsExceptionForNumbersOutOfRange(int $input): void {
        $fizzBuzz = new FizzBuzz();
        $this->expectException(OutOfRangeException::class);
        $fizzBuzz->convert($input);
    }
}
