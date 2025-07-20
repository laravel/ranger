<?php

namespace Laravel\Ranger\Types;

class AbstractType
{
    public bool $nullable = false;

    public bool $required = true;

    public bool $quote = false;

    public function nullable(bool $nullable = true): static
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function required(bool $required = true): static
    {
        $this->required = $required;

        return $this;
    }

    public function optional(bool $optional = true): static
    {
        $this->required = ! $optional;

        return $this;
    }

    public function quote(bool $quote = true): static
    {
        $this->quote = $quote;

        return $this;
    }

    public function isOptional(): bool
    {
        return ! $this->required;
    }
}
