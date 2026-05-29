<?php

namespace Illuminate\Database\Eloquent\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Visible
{
    public array $columns;

    public function __construct(array|string ...$columns)
    {
        $this->columns = count($columns) === 1 && is_array($columns[0]) ? $columns[0] : $columns;
    }
}

#[\Attribute(\Attribute::TARGET_CLASS)]
class Hidden
{
    public array $columns;

    public function __construct(array|string ...$columns)
    {
        $this->columns = count($columns) === 1 && is_array($columns[0]) ? $columns[0] : $columns;
    }
}

#[\Attribute(\Attribute::TARGET_CLASS)]
class Appends
{
    public array $columns;

    public function __construct(array|string ...$columns)
    {
        $this->columns = count($columns) === 1 && is_array($columns[0]) ? $columns[0] : $columns;
    }
}
