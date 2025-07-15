<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class AssertTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\AssertTagValueNode $node): ResultContract
    {
        dd('AssertTagValueNode not implemented yet');
    }
}
