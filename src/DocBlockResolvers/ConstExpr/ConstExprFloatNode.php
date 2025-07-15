<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprFloatNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprFloatNode $node): ResultContract
    {
        dd('ConstExprFloatNode not implemented yet');
    }
}
