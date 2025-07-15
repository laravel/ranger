<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprFalseNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprFalseNode $node): ResultContract
    {
        dd('ConstExprFalseNode not implemented yet');
    }
}
