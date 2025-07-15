<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class MethodTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\MethodTagValueNode $node): ResultContract
    {
        dd('MethodTagValueNode not implemented yet');
    }
}
