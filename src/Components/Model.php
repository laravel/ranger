<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Types\Contracts\Type;

class Model
{
    /**
     * @var array<string, Type>
     */
    protected array $attributes = [];

    /**
     * @var array<string, Type>
     */
    protected array $relations = [];

    public function __construct(public readonly string $name)
    {
        //
    }

    public function addAttribute(string $name, Type $type): void
    {
        $this->attributes[$name] = $type;
    }

    public function addRelation(string $name, Type $type): void
    {
        $this->relations[$name] = $type;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getRelations(): array
    {
        return $this->relations;
    }
}
