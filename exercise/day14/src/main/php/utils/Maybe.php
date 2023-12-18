<?php

namespace Utils;

class Maybe
{

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function just($value): Maybe
    {
        return new self($value);
    }

    public static function nothing(): Maybe
    {
        return new self(false);
    }

    public function map(callable $fn): Maybe
    {
        if ($this->value === false) {
            return self::nothing();
        }
        return self::just($fn($this->value));
    }

    public function getOrElse($defaultValue)
    {
        return $this->value ? $this->value : $defaultValue;
    }
}