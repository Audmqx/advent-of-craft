<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Diamond;
use Innmind\BlackBox\{
    PHPUnit\BlackBox,
    Set,
};
use Fixtures\Innmind\Immutable;
use Fixtures\Innmind\Immutable\Set as ImmutableSet;

// The program will take a parameter a letter indicating the depth of the diamond.
// supplying C as parameter will display:
//   A
//  B B
// C   C
//D     D
//  B B
//   A
    
class DiamondTest extends TestCase
{
    use BlackBox;
    
    public function test_proprety_based()
    {
        $this->forAll(Set\Chars::uppercaseLetter())
        ->then( function($character) {

        $expectedDiamondShape = $this->generateDiamondShape($character);
        $diamond = new Diamond($character);
        $this->assertSame($expectedDiamondShape, $diamond->shape());

        });
    }

    public function generateDiamondShape($letter) {
        $alphabet = range('A', 'Z');
        $indexEnd = array_search($letter, $alphabet);
        $lines = [];
    
        for ($i = 0; $i <= $indexEnd; $i++) {
            if ($i == 0) {
                $line = 'A';
            } else {
                $spacesInside = str_repeat(' ', max(0, $i * 2 - 1));
                $line = $alphabet[$i] . $spacesInside . $alphabet[$i];
            }
            $lines[] = $line;
        }
    
        for ($i = $indexEnd - 1; $i >= 0; $i--) {
            $spacesInside = str_repeat(' ', max(0, $i * 2 - 1));
            $line = $i == 0 ? 'A' : $alphabet[$i] . $spacesInside . $alphabet[$i];
            $lines[] = $line;
        }
    
        return $lines;
    }
}