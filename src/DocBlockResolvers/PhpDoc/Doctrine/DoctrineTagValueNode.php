<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc\Doctrine;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class DoctrineTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\Doctrine\DoctrineTagValueNode $node): ResultContract
    {
        dd('DoctrineTagValueNode not implemented yet');
    }
}
