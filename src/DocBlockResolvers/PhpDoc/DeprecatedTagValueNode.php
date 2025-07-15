<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DeprecatedTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\DeprecatedTagValueNode $node): ResultContract
    {
        dd('DeprecatedTagValueNode not implemented yet');
    }
}
