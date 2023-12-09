<?php

namespace Main;

class PasswordValidator
{
    const MINIMUM_LENGTH = 8;
    const CAPITALS = 'A-Z';
    const LOWERCASES = 'a-z';
    const NUMBERS = '\d';
    const SPECIAL_CHARACTERS = ['.', '*', '#', '@', '$', '%', '&'];

    public function __construct(private string $password){
    }

    public function isValid(): bool
    {
        return $this->isLongEnough() && $this->isHavingCapitals() && $this->isHavinglowercase() && $this->isHavingAuthorizedSpecialCharacters() && !$this->isHavingUnauthorizedSpecialCharacters();
    }

    public function isLongEnough(): bool
    {
        return strlen($this->password) >= self::MINIMUM_LENGTH;
    }

    public function isHavingCapitals(): bool
    {
        return preg_match('/['.self::CAPITALS.']/', $this->password) > 0;
    }

    public function isHavinglowercase(): bool
    {
        return preg_match('/['.self::LOWERCASES.']/', $this->password) > 0;
    }

    public function isHavingNumber(): bool
    {
        return preg_match('/'.self::NUMBERS.'/', $this->password) > 0;
    }

    public function isHavingAuthorizedSpecialCharacters(): bool
    {
        $pattern = '/[' . preg_quote(implode(self::SPECIAL_CHARACTERS), '/') . ']/';

        return preg_match($pattern, $this->password) > 0;
    }

    public function isHavingUnauthorizedSpecialCharacters(): bool
    {
        $pattern = $this->buildAllowedCharactersPattern();

        $inversePattern = '/[^' . (is_array($pattern) ? implode('', $pattern) : $pattern) . ']/';

        return preg_match($inversePattern, $this->password) > 0;
    }

    private function buildAllowedCharactersPattern(): array
    {
        return array_merge(
            str_split(self::CAPITALS),
            str_split(self::LOWERCASES),
            str_split(self::NUMBERS),
            str_split(implode(self::SPECIAL_CHARACTERS))
        );
    }
}