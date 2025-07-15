<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class PureUnlessCallableIsImpureTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\PureUnlessCallableIsImpureTagValueNode $node): ResultContract
    {
        dd('PureUnlessCallableIsImpureTagValueNode not implemented yet');
    }
}
