<?php

namespace Laravel\Ranger\DocBlockResolvers\ConstExpr;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ConstFetchNode extends AbstractResolver
{
    public function resolve(Ast\ConstExpr\ConstFetchNode $node): ResultContract
    {
        dd('ConstFetchNode not implemented yet');
    }
}
