<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class SelfOutTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\SelfOutTagValueNode $node): ResultContract
    {
        dd('SelfOutTagValueNode not implemented yet');
    }
}
