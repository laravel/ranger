<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ObjectShapeItemNode extends AbstractResolver
{
    public function resolve(Ast\Type\ObjectShapeItemNode $node): ResultContract
    {
        dd('ObjectShapeItemNode not implemented yet');
    }
}
