<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class PhpDocNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\PhpDocNode $node): ResultContract
    {
        dd('PhpDocNode not implemented yet');
    }
}
