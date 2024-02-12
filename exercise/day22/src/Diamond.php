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
        
        return $this->upperSide();
    }

    
    public function upperSide(): array
    {
        $upperArray = [];

        array_push($upperArray, 'A');
        for ($i=1; $i < ( $this->positionInTheAlphabet() + 1 ); $i++) { 
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

        for ($i=0; $i < $this->positionInTheAlphabet(); $i++) { 
            $blanks .= " ";
        }
      
        return $character.$blanks.$character;
    }

    public function positionInTheAlphabet(): int
    {
        $position = array_search($this->initialCharacter, $this->alphabet());

        if ($position !== false) {
           return $position; 
        }
    }


    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}