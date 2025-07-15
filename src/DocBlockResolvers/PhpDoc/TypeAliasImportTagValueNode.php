<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class TypeAliasImportTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\TypeAliasImportTagValueNode $node): ResultContract
    {
        dd('TypeAliasImportTagValueNode not implemented yet');
    }
}
