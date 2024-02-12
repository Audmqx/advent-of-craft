<?php

Namespace App;

class Diamond
{

    public function __construct(private string $shape)
    {
        
    }

    public function shape()
    {
        $this->upperSide();
        return "AA";
    }

    
    public function upperSide():array
    {
        $upperArray = [];
        var_dump("begin");
        for ($i=0; $i < $this->depth(); $i++) { 
            var_dump($i);
            array_push($upperArray, $this->alphabet()[$i]);
        }
        var_dump("end");
        return $upperArray;
    }



    public function addLineToDiamond(string $character): string
    {
        $blanks = '';

        for ($i=0; $i < $this->spacesBetweenChars(); $i++) { 
            $blanks .= " ";
        }
    
        return $character.$blanks.$character;
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