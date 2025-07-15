<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ConstantArrayType extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantArrayType $node): ResultContract
    {
        $result = [];

        foreach ($node->getKeyTypes() as $i => $keyType) {
            $result[$this->from($keyType)->value] = $this->from($node->getValueTypes()[$i]);
        }

        return RangerType::array($result);
    }
}
