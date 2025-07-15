<?php

namespace Laravel\Ranger\DocBlockResolvers\NodeVisitor;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class CloningVisitor extends AbstractResolver
{
    public function resolve(Ast\NodeVisitor\CloningVisitor $node): ResultContract
    {
        dd('CloningVisitor not implemented yet');
    }
}
