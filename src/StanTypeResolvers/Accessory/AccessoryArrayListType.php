<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use PHPStan\Type;

class AccessoryArrayListType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryArrayListType $node): ?Result
    {
        // TODO: Is this right?
        return null;
    }
}
