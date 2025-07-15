<?php

namespace Laravel\Ranger\DocBlockResolvers\PhpDoc;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class TemplateTagValueNode extends AbstractResolver
{
    public function resolve(Ast\PhpDoc\TemplateTagValueNode $node): ResultContract
    {
        dd('TemplateTagValueNode not implemented yet');
    }
}
