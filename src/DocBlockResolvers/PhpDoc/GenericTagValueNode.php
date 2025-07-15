<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class GenericTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\GenericTagValueNode $node): ResultContract
    {
        dd('GenericTagValueNode not implemented yet');
    }
}
