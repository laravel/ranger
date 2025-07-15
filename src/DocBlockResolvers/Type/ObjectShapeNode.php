<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ObjectShapeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ObjectShapeNode $node): ResultContract
    {
        dd('ObjectShapeNode not implemented yet');
    }
}
