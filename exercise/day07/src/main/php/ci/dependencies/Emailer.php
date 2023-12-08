<?php

namespace Ci\Dependencies;

interface Emailer {
    public function send(string $message): void;
}
