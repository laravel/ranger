<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class NullableTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\NullableTypeNode $node): ResultContract
    {
        dd('NullableTypeNode not implemented yet');
    }
}
