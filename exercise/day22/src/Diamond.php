<?php

Namespace App;

class Diamond
{
    private $lineLength = 0;

    public function __construct(private string $initialCharacter)
    {
    }

    public function shape()
    {
        if($this->initialCharacter === "A"){
            return ['A', '', 'A'];
        }
    
        $upperSide = $this->upperSide();
        return array_merge($upperSide, $this->lowerSide($upperSide));
    }

    
    private function upperSide(): array
    {
        $upperArray = [];

        array_push($upperArray, 'A');
        for ($i=1; $i < ( $this->positionInTheAlphabet($this->initialCharacter) + 1 ); $i++) { 
            array_push($upperArray, $this->addLineToDiamond($this->alphabet()[$i]));
        }
        return $upperArray;
    }

    private function lowerSide(array $upperSide): array
    {
        $reverse = array_reverse($upperSide);
        array_shift($reverse);
        return $reverse;
    }

    private function addLineToDiamond(string $character): string
    {

        if($this->lineLength != 0)
        {
            $blanks = $this->addBlankSpacesToline($this->lineLength);
            $this->lineLength = strlen($character.$blanks.$character);
            return $character.$blanks.$character;
        }
       
        $blanks = $this->addBlankSpacesToline($this->positionInTheAlphabet($character));
       
        $this->lineLength = strlen($character.$blanks.$character);

        return $character.$blanks.$character;
    }

    private function addBlankSpacesToline($blanksNumber)
    {
     
        $blanks = '';

        for ($i=0; $i < $blanksNumber; $i++) { 
            $blanks .= " ";
        }
      
        return $blanks;
    }

    private function positionInTheAlphabet(string $character): int
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