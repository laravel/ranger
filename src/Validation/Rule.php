<?php

namespace Laravel\Ranger\Validation;

use Illuminate\Validation\Rules\Enum;

class Rule
{
    public function __construct(
        protected array $rule,
    ) {
        //
    }

    public function rule(): mixed
    {
        return $this->rule[0];
    }

    public function getParams(): array
    {
        return $this->rule[1];
    }

    public function is(string $id): bool
    {
        return $this->rule() === $id;
    }

    public function isEnum(): bool
    {
        return $this->rule() instanceof Enum;
    }

    public function hasParams(): bool
    {
        return $this->getParams() !== [];
    }
}
