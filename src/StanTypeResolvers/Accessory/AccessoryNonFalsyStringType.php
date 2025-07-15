<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class AccessoryNonFalsyStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryNonFalsyStringType $node): ResultContract
    {
        return RangerType::string();
    }
}
