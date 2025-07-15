<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprArrayItemNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprArrayItemNode $node): ResultContract
    {
        dd('ConstExprArrayItemNode not implemented yet');
    }
}
