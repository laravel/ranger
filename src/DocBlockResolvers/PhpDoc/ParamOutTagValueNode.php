<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ParamOutTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ParamOutTagValueNode $node): ResultContract
    {
        dd('ParamOutTagValueNode not implemented yet');
    }
}
