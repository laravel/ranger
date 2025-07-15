<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ParamClosureThisTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ParamClosureThisTagValueNode $node): ResultContract
    {
        dd('ParamClosureThisTagValueNode not implemented yet');
    }
}
