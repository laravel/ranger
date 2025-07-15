<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class IntersectionTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\IntersectionTypeNode $node): ResultContract
    {
        dd('IntersectionTypeNode not implemented yet');
    }
}
