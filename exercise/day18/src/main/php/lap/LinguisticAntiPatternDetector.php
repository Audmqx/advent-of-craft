<?php

namespace Lap;

use ReflectionClass;

class LinguisticAntiPatternDetector
{

    public function ensureIsMethodHasRightReturn($class): bool
    {
        $reflectionClass = new ReflectionClass($class);

        foreach ($reflectionClass->getMethods() as $reflectionMethod) {
            if (strpos($reflectionMethod->getName(), 'is') !== 0) {
                continue;
            }

            $returnType = $reflectionMethod->getReturnType();

            if ($returnType === null || $returnType->getName() !== 'bool') {
                return false;
            }
        }

        return true;
    }

    public function areGettersReturningData($class): bool
    {
        $reflectionClass = new ReflectionClass($class);

        foreach ($reflectionClass->getMethods() as $reflectionMethod) {
            if (strpos($reflectionMethod->getName(), 'get') !== 0) {
                continue;
            }

            $returnType = $reflectionMethod->getReturnType();

            if ($returnType === null) {
                return false;
            }
        }

        return true;
    }
}