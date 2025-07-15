<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class MethodTagValueParameterNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\MethodTagValueParameterNode $node): ResultContract
    {
        dd('MethodTagValueParameterNode not implemented yet');
    }
}
