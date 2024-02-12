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

        $upperArray = $this->pushACharachter($upperArray);

        for ($i=0; $i < $this->positionInTheAlphabet(); $i++) { 
            array_push($upperArray, $this->addLineToDiamond($this->alphabet()[$i]));
        }
        
        $upperArray = $this->pushACharachter($upperArray);

        return $upperArray;
    }

    private function pushACharachter(array $array): array
    {
        return array_push($array, 'A');
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