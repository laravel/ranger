<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class RequireImplementsTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\RequireImplementsTagValueNode $node): ResultContract
    {
        dd('RequireImplementsTagValueNode not implemented yet');
    }
}
