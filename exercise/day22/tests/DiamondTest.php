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
//  B B
//   A
    
class DiamondTest extends TestCase
{
    use BlackBox;
    
    public function test_proprety_based()
    {
        $this->forAll(Set\Chars::uppercaseLetter())
        ->then( function($charachterDepth) {
            if($charachterDepth === "A") {
                $diamond = new Diamond('A');
                
                $depth = 1;
                $expectedShape = ['A','','A'];
                $this->assertSame($diamond->depth(), $depth);
                $this->assertSame(['A','','A'], $expectedShape);
            }
        });
    }
}