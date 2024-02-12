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
        
        return array_merge($this->upperSide(), $this->lowerSide());
    }

    
    public function upperSide(): array
    {
        $upperArray = [];

        array_push($upperArray, 'A');
        for ($i=1; $i < ( $this->positionInTheAlphabet($this->initialCharacter) + 1 ); $i++) { 
            array_push($upperArray, $this->addLineToDiamond($this->alphabet()[$i]));
        }

        return $upperArray;
    }

    public function lowerSide(): array
    {
        $reverse = array_reverse($this->upperSide());
        array_shift($reverse);
        return $reverse;
    }

    public function addLineToDiamond(string $character): string
    {
        $blanks = '';

        for ($i=0; $i < $this->positionInTheAlphabet($character); $i++) { 
            $blanks .= " ";
        }

        return $character.$blanks.$character;
    }

    public function positionInTheAlphabet(string $character): int
    {
        $position = array_search($character, $this->alphabet());

        if ($position !== false) {
           return $position; 
        }
    }


    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}