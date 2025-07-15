<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\PhpDocParser\Ast;

class ArrayTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ArrayTypeNode $node): ResultContract
    {
        return RangerType::arrayShape(RangerType::mixed(), RangerType::mixed());
    }
}
