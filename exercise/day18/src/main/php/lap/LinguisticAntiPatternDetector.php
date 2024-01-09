<?php

namespace Lap;

use ReflectionClass;

class LinguisticAntiPatternDetector
{
    private $reflectionClass;

    public function __construct($class)
    {
        $this->reflectionClass = new ReflectionClass($class);
    }

    public function validateIsMethod(): bool
    {
        return $this->validateMethods('is', 'bool');
    }

    public function validateGetters(): bool
    {
        return $this->validateMethods('get', null);
    }

    private function validateMethods(string $prefix, $expectedReturnType): bool
    {
        foreach ($this->reflectionClass->getMethods() as $reflectionMethod) {
            if (strpos($reflectionMethod->getName(), $prefix) !== 0) {
                continue;
            }

            $returnType = $reflectionMethod->getReturnType();

            if ($returnType === null || $returnType->getName() !== $expectedReturnType) {
                echo "Validation échouée pour la méthode {$reflectionMethod->getName()}\n";
                return false;
            }
        }

        return true;
    }

    public function validateUnderscoresInConstantNames(): bool
    {
        foreach ($this->reflectionClass->getReflectionConstants() as $reflectionConstant) {
            $constantName = $reflectionConstant->getName();

            if (strpos($constantName, '__') !== false || $constantName[0] === '_' || substr($constantName, -1) === '_') {
                echo "Validation échouée pour la constante $constantName\n";
                return false;
            }
        }

        return true;
    }
}