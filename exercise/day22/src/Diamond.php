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

    
    public function upperSide():array
    {
        $upperArray = [];
        for ($i=0; $i < $this->depth(); $i++) { 
            array_push($upperArray, $this->alphabet()[$i]);
        }
    
        return $upperArray;
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