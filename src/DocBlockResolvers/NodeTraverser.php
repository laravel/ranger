<?php

namespace Laravel\Ranger\DocBlockResolvers\NodeTraverser;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class NodeTraverser extends AbstractResolver
{
    public function resolve(Ast\NodeTraverser $node): ResultContract
    {
        dd('NodeTraverser not implemented yet');
    }
}
