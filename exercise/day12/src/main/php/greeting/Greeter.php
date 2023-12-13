<?php

namespace Greeting;

class Greeter implements Formality
{
    private $formality;

    public function greet() {
        if ($this->formality === null) {
            return "Hello.";
        }

        return $this->formality->greet();
    }

    public function setFormality(Formality $formality) {
        $this->formality = $formality;
    }
}
