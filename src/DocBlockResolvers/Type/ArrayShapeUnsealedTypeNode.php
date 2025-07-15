<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ArrayShapeUnsealedTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ArrayShapeUnsealedTypeNode $node): ResultContract
    {
        dd('ArrayShapeUnsealedTypeNode not implemented yet');
    }
}
