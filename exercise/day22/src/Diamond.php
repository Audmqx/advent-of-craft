<?php

Namespace App;

class Diamond
{

    public function __construct(private string $shape)
    {
        
    }

    public function depth(): int
    {
        return 1;
    }
}