<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class TypeAliasTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\TypeAliasTagValueNode $node): ResultContract
    {
        dd('TypeAliasTagValueNode not implemented yet');
    }
}
