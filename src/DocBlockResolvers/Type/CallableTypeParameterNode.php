<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class CallableTypeParameterNode extends AbstractResolver
{
    public function resolve(Ast\Type\CallableTypeParameterNode $node): ResultContract
    {
        dd('CallableTypeParameterNode not implemented yet');
    }
}
