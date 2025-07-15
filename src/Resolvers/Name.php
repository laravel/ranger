<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Name extends AbstractResolver
{
    public function resolve(Node\Name $node): ResultContract
    {
        if ($node->isSpecialClassName()) {
            return match ($node->name) {
                'self', 'static' => $this->resolveSelf($node),
                'parent' => $this->resolveParent($node),
                default => RangerType::from($node->name),
            };
        }

        return RangerType::from($node->toString());
    }

    protected function resolveParentClass(Node\Name $node): ?Node\Stmt\Class_
    {
        $parent = $node->getAttribute('parent');

        while ($parent && ! ($parent instanceof Node\Stmt\Class_)) {
            $parent = $parent->getAttribute('parent');
        }

        return $parent;
    }

    protected function resolveSelf(Node\Name $node): ResultContract
    {
        $parent = $this->resolveParentClass($node);

        if ($parent instanceof Node\Stmt\Class_) {
            return RangerType::from($parent->name->toString());
        }

        dd($node, 'cannot resolve self');
    }

    protected function resolveParent(Node\Name $node): ResultContract
    {
        $parent = $this->resolveParentClass($node);

        if ($parent instanceof Node\Stmt\Class_) {
            return $this->from($parent->extends);
        }

        dd($node, 'cannot resolve parent');
    }
}
