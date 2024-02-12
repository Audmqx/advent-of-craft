<?php

Namespace App;

class Diamond
{

    public function __construct(private string $shape)
    {
        
    }

    public function shape():array
    {
        return ['A','','A'];
    }

    public function depth(): int
    {
        $alphabet = range('A', 'Z');
        var_dump($alphabet[$this->shape] + 1);
        return 1;
    }
}