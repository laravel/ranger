<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class ArrayShapeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ArrayShapeNode $node): ResultContract
    {
        $arr = [];

        foreach ($node->items as $item) {
            $arr[] = $this->from($item);
        }

        $arr = array_map(fn ($i) => TypeScript::indent($i), $arr);

        return implode(PHP_EOL, ['{', implode(';'.PHP_EOL, $arr).';', '}']);
    }
}
