<?php

Namespace App;

class Diamond
{

    public function __construct(private string $initialCharacter)
    {
        
    }

    public function shape()
    {
        var_dump($this->upperSide());
        return "AA";
    }

    
    public function upperSide():array
    {
        $upperArray = [];
        for ($i=0; $i < $this->depth(); $i++) { 
            var_dump(666666);
            array_push($upperArray, $this->alphabet()[$i]);
        }
        
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
        return $this->alphabet()[$this->initialCharacter] + 1; // additional is because array starts at 0
    }

    public function spacesBetweenChars(): int
    {
        return $this->alphabet()[$this->initialCharacter];
    }

    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}