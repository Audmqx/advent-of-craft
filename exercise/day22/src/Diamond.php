<?php

Namespace App;

class Diamond
{

    public function __construct(private string $initialCharacter)
    {
        
    }

    public function shape()
    {
        if($this->initialCharacter === "A"){
            return ['A', '', 'A'];
        }
        
        return $this->upperSide()[0];
    }

    
    public function upperSide(): array
    {
        $upperArray = [];
        for ($i=0; $i < $this->depth(); $i++) { 
            array_push($upperArray, $this->addLineToDiamond($this->alphabet()[$i]));
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
        var_dump($this->initialCharacter);
        return $this->alphabet()[$this->initialCharacter] + 1; // additional is because array starts at 0
    }

    public function spacesBetweenChars()
    {
        return $this->alphabet()[$this->initialCharacter];
    }

    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}