<?php

namespace Laravel\Ranger\Types;

use Illuminate\Support\Facades\Facade;
use ReflectionClass;

class ClassType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly string $value)
    {
        //
    }

    public function resolved(): string
    {
        $reflection = new ReflectionClass($this->value);

        if ($reflection->isSubclassOf(Facade::class)) {
            return get_class($this->value::getFacadeRoot());
        }

        return $this->value;
    }
}
