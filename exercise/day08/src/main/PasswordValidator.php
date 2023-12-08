<?php

namespace Main;

class PasswordValidator
{
    const MINIMUM_LENGTH = 8;
    public function __construct(private string $password){
    }

    public function isLongEnough()
    {
        return strlen($this->password) >= self::MINIMUM_LENGTH ? true : false;
    }
}