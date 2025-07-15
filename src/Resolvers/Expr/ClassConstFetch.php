<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class ClassConstFetch extends AbstractResolver
{
    public function resolve(Node\Expr\ClassConstFetch $node): ResultContract
    {
        if ($node->name->toString() === 'class') {
            // TODO: Or `string`??
            return RangerType::string($node->class->name);
        }

        if (enum_exists($node->class->name)) {
            // If the class is an enum, we can return the enum type
            dd($node->class->name, $node->name, 'enum exists', get_class($this).' not implemented yet');

            return RangerType::enum($node->class->name);
        }

        dd($node, get_class($this).' not implemented yet');
    }
}
