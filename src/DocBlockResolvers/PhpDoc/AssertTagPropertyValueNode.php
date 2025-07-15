<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class AssertTagPropertyValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\AssertTagPropertyValueNode $node): ResultContract
    {
        dd('AssertTagPropertyValueNode not implemented yet');
    }
}
