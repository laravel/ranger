<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PregSplitDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PregSplitDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'PregSplitDynamicReturnTypeExtension not implemented yet');
    }
}
