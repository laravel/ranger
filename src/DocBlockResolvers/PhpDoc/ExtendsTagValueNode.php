<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ExtendsTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ExtendsTagValueNode $node): ResultContract
    {
        dd('ExtendsTagValueNode not implemented yet');
    }
}
