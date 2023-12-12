<?php

use Greeting\Greeter;
use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase {
    public function testSaysHello() {
        $greeter = new Greeter();

        $this->assertEquals("Hello.", $greeter->greet());
    }

    public function testSaysHelloFormally() {
        $greeter = new Greeter();
        $greeter->setFormality("formal");

        $this->assertEquals("Good evening, sir.", $greeter->greet());
    }

    public function testSaysHelloCasually() {
        $greeter = new Greeter();
        $greeter->setFormality("casual");

        $this->assertEquals("Sup bro?", $greeter->greet());
    }

    public function testSaysHelloIntimately() {
        $greeter = new Greeter();
        $greeter->setFormality("intimate");

        $this->assertEquals("Hello Darling!", $greeter->greet());
    }
}