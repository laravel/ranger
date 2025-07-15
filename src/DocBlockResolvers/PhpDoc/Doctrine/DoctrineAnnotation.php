<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc\Doctrine;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineAnnotation extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\Doctrine\DoctrineAnnotation $node): ResultContract
    {
        dd('DoctrineAnnotation not implemented yet');
    }
}
