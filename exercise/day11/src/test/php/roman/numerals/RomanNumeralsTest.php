<?php


use PHPUnit\Framework\TestCase;
use roman\numerals\RomanNumerals;

class RomanNumeralsTest extends TestCase
{
    /**
     * @return array
     */
    public static function passingExamples(): array
    {
        return [
            [1, "I"],
            [3, "III"],
            [4, "IV"],
            [5, "V"],
            [10, "X"],
            [13, "XIII"],
            [50, "L"],
            [100, "C"],
            [500, "D"],
            [1000, "M"],
            [2499, "MMCDXCIX"],
        ];
    }

    /**
     * @dataProvider passingExamples
     *
     * @param int $number
     * @param string $expectedRoman
     */
    public function testGenerateRomanForNumbers(int $number, string $expectedRoman): void
    {
        $this->assertEquals($expectedRoman, RomanNumerals::convert($number));
    }

    public function testReturnsOnlyValidSymbolsForValidNumbers(): void
    {
        $validNumbers = range(1, 3999);

        foreach ($validNumbers as $validNumber) {
            $roman = RomanNumerals::convert($validNumber);

            if (method_exists($this, 'assertMatchesRegularExpression')) {
                $this->assertMatchesRegularExpression('/^[IVXLCDM]+$/', $roman);
            } else {
                $this->assertRegExp('/^[IVXLCDM]+$/', $roman);
            }
        }
    }
}

