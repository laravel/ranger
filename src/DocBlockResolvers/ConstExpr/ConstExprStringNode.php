<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprStringNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprStringNode $node): ResultContract
    {
        dd('ConstExprStringNode not implemented yet');
    }
}
