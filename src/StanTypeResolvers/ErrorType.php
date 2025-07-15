<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ErrorType extends AbstractResolver
{
    public function resolve(Type\ErrorType $node): ResultContract
    {
        // TODO: Is this right?
        return RangerType::mixed();
    }
}
