<?php

use Account\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase {
    private $client;

    protected function setUp(): void {
        $this->client = new Client([
            ["key" => "Tenet Deluxe Edition", "value" => 45.99],
            ["key" => "Inception", "value" => 30.50],
            ["key" => "The Dark Knight", "value" => 30.50],
            ["key" => "Interstellar", "value" => 23.98]
        ]);
    }

    public function testClientShouldReturnStatement() {
        $statement = $this->client->toStatement();

        $this->assertEquals(130.97, $this->client->getTotalAmount());
        $this->assertEquals(
            "Tenet Deluxe Edition for 45.99€" . PHP_EOL .
            "Inception for 30.5€" . PHP_EOL .
            "The Dark Knight for 30.5€" . PHP_EOL .
            "Interstellar for 23.98€" . PHP_EOL .
            "Total : 130.97€",
            $statement
        );
    }
}