<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class UsesTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\UsesTagValueNode $node): ResultContract
    {
        dd('UsesTagValueNode not implemented yet');
    }
}
