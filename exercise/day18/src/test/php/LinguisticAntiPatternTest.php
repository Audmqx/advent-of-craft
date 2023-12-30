<?php

use PHPUnit\Framework\TestCase;
use Lap\LinguisticAntiPatternDetector;
use Lap\ShittyClass;

class LinguisticAntiPatternTest extends TestCase
{
    private $LAPDetector;
    public function setUp(): void
    {
        $this->LAPDetector = new LinguisticAntiPatternDetector();
    }

    public function test_method_is_has_missing_return()
    {
        $shittyClass = new ShittyClass();
        $this->assertFalse($this->LAPDetector->ensureIsMethodHasRightReturn($shittyClass));
    }

    public function test_getter_has_missing_return()
    {
        $shittyClass = new ShittyClass();
        $this->assertFalse($this->LAPDetector->areGettersReturningData($shittyClass));
    }

}

