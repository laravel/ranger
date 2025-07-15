<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class PropertyTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\PropertyTagValueNode $node): ResultContract
    {
        dd('PropertyTagValueNode not implemented yet');
    }
}
