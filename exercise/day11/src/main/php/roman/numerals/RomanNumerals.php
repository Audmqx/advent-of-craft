<?php

namespace roman\numerals;

class RomanNumerals
{
    private const MAX_NUMBER = 3999;
    private static array $intToNumerals = [];

    private function __construct()
    {
    }

    private static function createMapForIntegerToNumerals(): void
    {
        self::$intToNumerals = [
            1000 => "M",
            900 => "CM",
            500 => "D",
            400 => "CD",
            100 => "C",
            90 => "XC",
            50 => "L",
            40 => "XL",
            10 => "X",
            9 => "IX",
            5 => "V",
            4 => "IV",
            1 => "I",
        ];
    }

    public static function convert(int $number): ?string
    {
        return self::isInRange($number)
            ? self::convertSafely($number)
            : null;
    }

    private static function convertSafely(int $number): ?string
    {
        self::createMapForIntegerToNumerals();

        $roman = '';
        $remaining = $number;

        foreach (self::$intToNumerals as $toRoman => $numeral) {
            while ($remaining >= $toRoman) {
                $roman .= $numeral;
                $remaining -= $toRoman;
            }
        }

        return $roman;
    }

    private static function isInRange(int $number): bool
    {
        return $number > 0 && $number <= self::MAX_NUMBER;
    }
}
