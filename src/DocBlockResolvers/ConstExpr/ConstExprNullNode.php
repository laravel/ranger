<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprNullNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprNullNode $node): ResultContract
    {
        dd('ConstExprNullNode not implemented yet');
    }
}
