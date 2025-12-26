<?php

namespace Laravel\Ranger\Components;

use Laravel\Surveyor\Types\Contracts\Type;

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

    protected bool $snakeCaseAttributes = true;

    public function __construct(public readonly string $name)
    {
        //
    }

    public function setSnakeCaseAttributes(bool $snakeCaseAttributes): void
    {
        $this->snakeCaseAttributes = $snakeCaseAttributes;
    }

    public function snakeCaseAttributes(): bool
    {
        return $this->snakeCaseAttributes;
    }

    /**
     * @return array<string, Type>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return array<string, Type>
     */
    public function getRelations(): array
    {
        return $this->relations;
    }

    public function addAttribute(string $name, Type $type): void
    {
        $this->attributes[$name] = $type;
    }

    public function addRelation(string $name, Type $type): void
    {
        $this->relations[$name] = $type;
    }
}
