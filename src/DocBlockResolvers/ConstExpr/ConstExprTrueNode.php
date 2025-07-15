<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprTrueNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprTrueNode $node): ResultContract
    {
        dd('ConstExprTrueNode not implemented yet');
    }
}
