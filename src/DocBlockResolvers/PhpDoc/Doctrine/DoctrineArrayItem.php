<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc\Doctrine;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineArrayItem extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\Doctrine\DoctrineArrayItem $node): ResultContract
    {
        dd('DoctrineArrayItem not implemented yet');
    }
}
