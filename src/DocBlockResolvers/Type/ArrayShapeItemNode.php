<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ArrayShapeItemNode extends AbstractResolver
{
    public function resolve(Ast\Type\ArrayShapeItemNode $node): ResultContract
    {
        $key = $node->keyName;

        if (! $key) {
            return $this->from($node->valueType);
        }

        $def = TypeScript::quoteKey($key);

        if ($node->optional) {
            $def .= '?';
        }

        return $def.': '.$this->from($node->valueType);
    }
}
