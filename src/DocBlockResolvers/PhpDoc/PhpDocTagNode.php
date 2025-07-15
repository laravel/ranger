<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class PhpDocTagNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\PhpDocTagNode $node): ResultContract
    {
        dd('PhpDocTagNode not implemented yet');
    }
}
