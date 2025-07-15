<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class InvalidTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\InvalidTypeNode $node): ResultContract
    {
        dd('InvalidTypeNode not implemented yet');
    }
}
