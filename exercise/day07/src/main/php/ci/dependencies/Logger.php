<?php

namespace Ci\Dependencies;

interface Logger {
    public function info(string $message): void;

    public function error(string $message): void;
}
