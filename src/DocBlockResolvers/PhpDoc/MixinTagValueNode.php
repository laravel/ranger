<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class MixinTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\MixinTagValueNode $node): ResultContract
    {
        dd('MixinTagValueNode not implemented yet');
    }
}
