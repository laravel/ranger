<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ParamLaterInvokedCallableTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ParamLaterInvokedCallableTagValueNode $node): ResultContract
    {
        dd('ParamLaterInvokedCallableTagValueNode not implemented yet');
    }
}
