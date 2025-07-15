<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ConstTypeNode $node): ResultContract
    {
        dd('ConstTypeNode not implemented yet');
    }
}
