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
        return $this->alphabet()[$this->shape] + 1; // additional is because array starts at 0
    }

    public function spacesBetweenChars(): int
    {
        return $this->alphabet()[$this->shape];
    }

    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}