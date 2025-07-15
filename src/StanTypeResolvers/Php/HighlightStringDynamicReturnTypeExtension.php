<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HighlightStringDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\HighlightStringDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'HighlightStringDynamicReturnTypeExtension not implemented yet');
    }
}
