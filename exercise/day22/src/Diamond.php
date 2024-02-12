<?php

Namespace App;

class Diamond
{

    public function __construct(private string $shape)
    {
        
    }

    public function shape():array
    {
        // particular case as between the shapes there is no space
        if( $this->depth(1) ){
            
        }
        return ['A','','A'];
    }

    public function depth(): int
    {
        return $this->alphabet()[$this->shape] + 1; // additional is because array starts at 0
    }

    private function alphabet(): array
    {
        return range('A', 'Z');
    }
}