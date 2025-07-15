<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ParamImmediatelyInvokedCallableTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ParamImmediatelyInvokedCallableTagValueNode $node): ResultContract
    {
        dd('ParamImmediatelyInvokedCallableTagValueNode not implemented yet');
    }
}
