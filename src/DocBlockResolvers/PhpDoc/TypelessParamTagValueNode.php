<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class TypelessParamTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\TypelessParamTagValueNode $node): ResultContract
    {
        dd('TypelessParamTagValueNode not implemented yet');
    }
}
