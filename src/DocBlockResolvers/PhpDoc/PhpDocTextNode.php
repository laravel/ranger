<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class PhpDocTextNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\PhpDocTextNode $node): ResultContract
    {
        dd('PhpDocTextNode not implemented yet');
    }
}
