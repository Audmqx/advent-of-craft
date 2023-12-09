<?php

namespace Account;

class Client {
    private float $totalAmount = 0;

    public function __construct(private array $orderLines) {
    }

    public function toStatement() {
        $this->initialiseTotalAmount();
        return $this->writeOrderLines() . $this->writeTotalOfTheOrder();
    }

    private function initialiseTotalAmount(): void
    {
        $this->totalAmount = 0;
    }

    private function writeOrderLines(): string
    {
        return implode(PHP_EOL, array_map(function ($entry) {
            return $this->formatLine($entry['key'], $entry['value']);
        }, $this->orderLines));
    }

    private function formatLine($name, $value) {
        $this->totalAmount += $value;
        return $name . " for " . $value . "€";
    }

    private function writeTotalOfTheOrder(): string{
        return PHP_EOL . "Total : " . $this->totalAmount . "€";
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }
}
