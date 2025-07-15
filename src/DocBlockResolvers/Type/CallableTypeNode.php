<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class CallableTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\CallableTypeNode $node): ResultContract
    {
        dd('CallableTypeNode not implemented yet');
    }
}
