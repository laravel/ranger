<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc\Doctrine;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineArray extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\Doctrine\DoctrineArray $node): ResultContract
    {
        dd('DoctrineArray not implemented yet');
    }
}
