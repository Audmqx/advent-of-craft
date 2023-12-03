<?php

namespace People;

class Pet {

    public function __construct(
        public string $type,
        public  string $name,
        public  int $age) {
    }
}
