<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConditionalTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ConditionalTypeNode $node): ResultContract
    {
        dd('ConditionalTypeNode not implemented yet');
    }
}
