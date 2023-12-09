<?php

namespace Account;

class Client {
    private $orderLines;
    private $totalAmount;

    public function __construct($orderLines) {
        $this->orderLines = $orderLines;
    }

    public function toStatement() {
        return implode(PHP_EOL, array_map(function ($entry) {
                return $this->formatLine($entry['key'], $entry['value']);
            }, $this->orderLines)) . PHP_EOL . "Total : " . $this->totalAmount . "€";
    }

    private function formatLine($name, $value) {
        $this->totalAmount += $value;
        return $name . " for " . $value . "€";
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }
}
