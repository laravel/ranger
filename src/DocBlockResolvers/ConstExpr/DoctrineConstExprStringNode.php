<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineConstExprStringNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\DoctrineConstExprStringNode $node): ResultContract
    {
        dd('DoctrineConstExprStringNode not implemented yet');
    }
}
