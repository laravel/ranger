<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;
use PhpParser\Node\FunctionLike;

class ClassMethod extends AbstractResolver
{
    public function resolve(Node\Stmt\ClassMethod $node): ResultContract
    {
        $returnNodes = $this->parser->nodeFinder()->find(
            $node,
            static function (Node $n) use ($node): bool {
                // pick only Return_ nodes
                if (! ($n instanceof Node\Stmt\Return_)) {
                    return false;
                }

                // walk up until we hit the first FunctionLike ancestor
                $parent = $n->getAttribute('parent');

                while ($parent && ! ($parent instanceof FunctionLike)) {
                    $parent = $parent->getAttribute('parent');
                }

                // keep the Return_ only if that first FunctionLike is the method itself
                return $parent === $node;
            }
        );

        return RangerType::union(...array_map(
            fn ($n) => $this->from($n->expr),
            $returnNodes,
        ));
    }
}
