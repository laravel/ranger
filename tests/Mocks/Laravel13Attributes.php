<?php

namespace Illuminate\Database\Eloquent\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Visible
{
    public function __construct(public array $columns) {}
}

#[\Attribute(\Attribute::TARGET_CLASS)]
class Hidden
{
    public function __construct(public array $columns) {}
}

#[\Attribute(\Attribute::TARGET_CLASS)]
class Appends
{
    public function __construct(public array $columns) {}
}
