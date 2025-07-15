<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ThrowsTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ThrowsTagValueNode $node): ResultContract
    {
        dd('ThrowsTagValueNode not implemented yet');
    }
}
