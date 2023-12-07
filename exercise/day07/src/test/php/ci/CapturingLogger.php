<?php

namespace CiTest;

use Ci\Dependencies\Logger;
use \ArrayObject;

class CapturingLogger implements Logger {
    private $lines;

    public function __construct() {
        $this->lines = new ArrayObject();
    }

    public function info(string $message): void {
        $this->lines[] = "INFO: " . $message;
    }

    public function error(string $message): void {
        $this->lines[] = "ERROR: " . $message;
    }

    public function getLoggedLines(): array {
        return $this->lines->getArrayCopy();
    }
}
