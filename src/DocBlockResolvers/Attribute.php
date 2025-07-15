<?php

namespace Laravel\Ranger\DocBlockResolvers\Attribute;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class Attribute extends AbstractResolver
{
    public function resolve(Ast\Attribute $node): ResultContract
    {
        dd('Attribute not implemented yet');
    }
}
