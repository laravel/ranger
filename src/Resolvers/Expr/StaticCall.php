<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\ClassResult;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class StaticCall extends AbstractResolver
{
    public function resolve(Node\Expr\StaticCall $node): ResultContract
    {
        $stanType = $this->getStanType($node);

        if ($stanType instanceof ClassResult && $stanType->value === 'Inertia\\LazyProp') {
            return RangerType::from($this->from($node->getArgs()[0]))->optional();
        }

        if ($stanType !== null) {
            return $stanType;
        }

        $varType = $this->from($node->class);

        if ($varType instanceof ClassResult || (is_string($varType) && class_exists($varType))) {
            $varType = $varType instanceof ClassResult ? $varType->resolved() : $varType;
            $returnType = $this->reflector->methodReturnType($varType, $node->name->name, $node);

            if ($returnType) {
                return $returnType;
            }
        }

        return RangerType::mixed();
    }
}
