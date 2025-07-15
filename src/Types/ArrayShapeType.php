<?php

namespace Laravel\Ranger\Types;

class ArrayShapeType extends AbstractType implements Contracts\Type
{
    public function __construct(
        public readonly Contracts\Type $keyType,
        public readonly Contracts\Type $valueType,
    ) {
        //
    }
}
