<?php

namespace Main;

class PasswordValidator
{
    const MINIMUM_LENGTH = 8;
    public function __construct(private string $password){
    }

    public function isLongEnough(): bool
    {
        return strlen($this->password) >= self::MINIMUM_LENGTH ? true : false;
    }

    public function isHavingCapitals(): bool
    {
        return preg_match('/[A-Z]/', $this->password) > 0 ? true : false;
    }

    public function isHavinglowercase(): bool
    {
        return true;
    }
}