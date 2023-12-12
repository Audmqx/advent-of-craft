<?php

namespace Greeting;

class Greeter {
    private $formality;

    public function greet() {
        if ($this->formality === null) {
            return "Hello.";
        }

        if ($this->formality === "formal") {
            return "Good evening, sir.";
        } elseif ($this->formality === "casual") {
            return "Sup bro?";
        } elseif ($this->formality === "intimate") {
            return "Hello Darling!";
        } else {
            return "Hello.";
        }
    }

    public function setFormality($formality) {
        $this->formality = $formality;
    }
}
