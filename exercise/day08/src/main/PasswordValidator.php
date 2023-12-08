<?php

namespace Main;

class PasswordValidator
{
    const MINIMUM_LENGTH = 8;
    const SPECIAL_CHARACTERS = ['.', '*', '#', '@', '$', '%', '&'];

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
        return preg_match('/[a-z]/', $this->password) > 0 ? true : false;
    }

    public function isHavingNumber(): bool
    {
        return preg_match('/\d/', $this->password) > 0 ? true : false;
    }

    public function isAuthorizedSpecialCharacters(): bool
    {
        $pattern = '/[' . preg_quote(implode(self::SPECIAL_CHARACTERS), '/') . ']/';

        return preg_match($pattern, $this->password) > 0 ? true : false;
    }
}