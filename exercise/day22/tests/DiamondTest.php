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
        ->then( function($characterDepth) {
            if($characterDepth === "A") {
                // $diamond = new Diamond('A');
                
                // $expectedShape = ['A', '', 'A'];
        
                // $this->assertSame($diamond->shape(), $expectedShape);
            } elseif ($characterDepth === "B") {
                $diamond = new Diamond('B');
                
                $expectedShape = ['A', 'B B', 'A'];
        
                $this->assertSame($diamond->positionInTheAlphabet(), 1);
                // $this->assertSame($expectedShape, $diamond->shape());
            }
        });
    }
}