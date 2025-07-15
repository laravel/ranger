<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstExprArrayNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstExprArrayNode $node): ResultContract
    {
        dd('ConstExprArrayNode not implemented yet');
    }
}
