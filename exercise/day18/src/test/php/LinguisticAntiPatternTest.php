<?php

use PHPUnit\Framework\TestCase;
use Lap\LinguisticAntiPatternDetector;
use Lap\ShittyClass;

class LinguisticAntiPatternTest extends TestCase
{
    private $LAPDetector;
    public function setUp(): void
    {
        $this->LAPDetector = new LinguisticAntiPatternDetector(new ShittyClass());
    }

    public function test_method_is_has_missing_return()
    {
        $this->assertFalse($this->LAPDetector->validateIsMethod());
    }

    public function test_getter_has_missing_return()
    {
        $this->assertFalse($this->LAPDetector->validateGetters());
    }

}

