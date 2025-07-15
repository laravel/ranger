<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class VarTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\VarTagValueNode $node): ResultContract
    {
        dd('VarTagValueNode not implemented yet');
    }
}
