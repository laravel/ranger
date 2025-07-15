<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\PhpDocParser\Ast;

class UnionTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\UnionTypeNode $node): ResultContract
    {
        return RangerType::union(
            ...collect($node->types)
                ->map(fn ($type) => $this->from($type))
                ->unique(),
        );
    }
}
