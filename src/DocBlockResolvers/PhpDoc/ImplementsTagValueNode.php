<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ImplementsTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ImplementsTagValueNode $node): ResultContract
    {
        dd('ImplementsTagValueNode not implemented yet');
    }
}
