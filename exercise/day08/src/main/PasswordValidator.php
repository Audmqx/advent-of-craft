<?php

namespace Main;

class PasswordValidator
{

    public function __construct(private string $password){
    }

    public function isLongEnough()
    {
        return true;
    }
}