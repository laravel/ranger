<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc\Doctrine;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineArgument extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\Doctrine\DoctrineArgument $node): ResultContract
    {
        dd('DoctrineArgument not implemented yet');
    }
}
