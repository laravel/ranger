<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Concerns\HasFilePath;
use Laravel\Surveyor\Types\Contracts\Type;

class Model
{
    use HasFilePath;

    /**
     * @var array<string, Type>
     */
    protected array $attributes = [];

    /**
     * @var array<string, Type>
     */
    protected array $relations = [];

    /**
     * @var list<string>
     */
    protected array $hidden = [];

    /**
     * @var list<string>
     */
    protected array $visible = [];

    /**
     * @var list<string>
     */
    protected array $appends = [];

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

    /**
     * @param  list<string>  $hidden
     */
    public function setHidden(array $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * @return list<string>
     */
    public function getHidden(): array
    {
        return $this->hidden;
    }

    /**
     * @param  list<string>  $visible
     */
    public function setVisible(array $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return list<string>
     */
    public function getVisible(): array
    {
        return $this->visible;
    }

    /**
     * @param  list<string>  $appends
     */
    public function setAppends(array $appends): void
    {
        $this->appends = $appends;
    }

    /**
     * @return list<string>
     */
    public function getAppends(): array
    {
        return $this->appends;
    }

    /**
     * Attributes and relations filtered through Eloquent's $visible/$hidden
     * serialization rules. $visible acts as a whitelist when non-empty;
     * otherwise $hidden removes the listed keys.
     *
     * @return array<string, Type>
     */
    public function visibleProperties(): array
    {
        $properties = array_merge($this->attributes, $this->relations);

        if ($this->visible !== []) {
            return array_intersect_key($properties, array_flip($this->visible));
        }

        if ($this->hidden !== []) {
            return array_diff_key($properties, array_flip($this->hidden));
        }

        return $properties;
    }
}
