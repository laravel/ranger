<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class AssertTagMethodValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\AssertTagMethodValueNode $node): ResultContract
    {
        dd('AssertTagMethodValueNode not implemented yet');
    }
}
