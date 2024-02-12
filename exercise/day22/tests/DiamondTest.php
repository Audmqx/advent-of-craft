<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Diamond;
use Fixtures\Innmind\Immutable;



// The program will take a parameter a letter indicating the depth of the diamond.
// supplying C as parameter will display:
//   A
//  B B
// C   C
//  B B
//   A
    
class DiamondTest extends TestCase
{
    public function test_that_diamond_is_one_depth()
    {
        //ARRANGE
        $diamond = new Diamond;

        //ACT

        //ASSERT
        $this->assertSame($diamond->shape('A'), "A");
    }
}