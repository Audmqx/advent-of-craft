<?php

use Greeting\Greeter;
use PHPUnit\Framework\TestCase;
use Greeting\Formal;
use Greeting\Intimate;
use Greeting\Casual;

class GreeterTest extends TestCase {
    private $greeter;

    public function setUp(): void
    {
        $this->greeter = new Greeter();
    }

    public function testSaysHello() {
        $this->assertEquals("Hello.", $this->greeter->greet());
    }

    public function testSaysHelloFormally() {
        $this->greeter->setFormality(new Formal);

        $this->assertEquals("Good evening, sir.", $this->greeter->greet());
    }

    public function testSaysHelloCasually() {
        $this->greeter->setFormality(new Casual());
        $this->assertEquals("Sup bro?", $this->greeter->greet());
    }

    public function testSaysHelloIntimately() {
        $this->greeter->setFormality(new Intimate());

        $this->assertEquals("Hello Darling!", $this->greeter->greet());
    }
}