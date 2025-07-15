<?php

namespace Laravel\Ranger\DocBlockResolvers\AbstractNodeVisitor;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class AbstractNodeVisitor extends AbstractResolver
{
    public function resolve(Ast\AbstractNodeVisitor $node): ResultContract
    {
        dd('AbstractNodeVisitor not implemented yet');
    }
}
