<?php

namespace Laravel\Ranger\Resolvers\Concerns;

use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

trait ResolvesProperties
{
    protected function resolveProperty(
        Node\Expr\PropertyFetch|Node\Expr\NullsafePropertyFetch $node
    ) {
        $stanType = $this->stan->getType($node);

        if ($stanType) {
            return $stanType;
        }

        $this->context['property_chain'] ??= [];
        $this->context['property_chain'][] = $node->name->name;

        if ($node->var instanceof Node\Expr\Variable) {
            return $this->resolvePropertyFromVariable($node->var);
        }

        return $this->from($node->var);
    }

    protected function resolvePropertyFromVariable(Node\Expr\Variable $node)
    {
        // We've reached the root, figure out the type of the variable and work backwards
        $variableType = $this->from($node);

        $chain = array_reverse($this->context['property_chain']);

        $type = null;

        foreach ($chain as $property) {
            try {
                $type = $this->reflector->propertyType($variableType, $property);
            } catch (\Throwable $e) {
                // TODO: Hm.
                continue;
            }

            if (! $type) {
                // If we can't find the type, we assume it's any
                return RangerType::mixed();
            }

            $variableType = $type;
        }

        return RangerType::from($variableType);
    }
}
