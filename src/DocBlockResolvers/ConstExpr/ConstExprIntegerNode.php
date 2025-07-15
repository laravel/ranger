<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprIntegerNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprIntegerNode $node): ResultContract
    {
        dd('ConstExprIntegerNode not implemented yet');
    }
}
