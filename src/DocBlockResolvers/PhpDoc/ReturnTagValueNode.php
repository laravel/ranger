<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ReturnTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\ReturnTagValueNode $node): ResultContract
    {
        return $this->from($node->type);
    }
}
