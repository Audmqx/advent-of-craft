<?php

namespace Test;

use Domain\Yahtzee\YahtzeeDiceRollValidator;
use PHPUnit\Framework\TestCase;
use Domain\Yahtzee\YahtzeeRollValidator;

class YahtzeeDiceRollCheckerTest extends TestCase
{
    public function test_roll_should_contain_5_dice()
    {
        // Arrange
        $diceRollValidator = new YahtzeeDiceRollValidator();

        // Act 
        $roll = $diceRollValidator->validateRoll([1,2]);

        // Assert
        $roll->match(
            fn($right) => $right,
            fn($error) => $this->assertSame("Invalid dice... A roll should contain 5 dice.", $error)
        );
    }
}
