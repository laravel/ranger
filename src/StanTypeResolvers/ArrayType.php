<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ArrayType extends AbstractResolver
{
    public function resolve(Type\ArrayType $node): ResultContract
    {
        return RangerType::arrayShape($this->from($node->getKeyType()), $this->from($node->getItemType()));
    }
}
