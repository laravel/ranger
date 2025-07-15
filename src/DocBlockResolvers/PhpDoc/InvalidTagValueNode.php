<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class InvalidTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\InvalidTagValueNode $node): ResultContract
    {
        dd('InvalidTagValueNode not implemented yet');
    }
}
