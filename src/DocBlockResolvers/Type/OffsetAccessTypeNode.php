<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class OffsetAccessTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\OffsetAccessTypeNode $node): ResultContract
    {
        dd('OffsetAccessTypeNode not implemented yet');
    }
}
