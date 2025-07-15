<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Closure extends AbstractResolver
{
    public function resolve(Node\Expr\Closure $node): ResultContract
    {
        $returns = collect($this->parser->nodeFinder()->find(
            $node,
            function ($n) use ($node) {
                if (! ($n instanceof Node\Stmt\Return_)) {
                    return false;
                }

                $parent = $n->getAttribute('parent');

                while ($parent && $parent !== $node) {
                    if ($parent instanceof Node\Expr\Closure) {
                        return false;
                    }

                    $parent = $parent->getAttribute('parent');
                }

                return $parent === $node;
            }
        ))->map(fn ($return) => $this->from($return->expr));

        $couldBeDictionary = $returns->contains(fn ($return) => is_array($return) && ! array_is_list($return));

        if ($couldBeDictionary) {
            return RangerType::array($returns);
        }

        if ($returns->isEmpty()) {
            return RangerType::mixed();
        }

        return RangerType::union(...$returns->unique());
    }
}
