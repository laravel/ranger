<?php

namespace Laravel\Ranger\Types\Contracts;

interface Type
{
    public function isOptional(): bool;

    public function quote(bool $quote = true): static;

    public function required(bool $required = true): static;

    public function optional(): static;

    public function nullable(bool $nullable = true): static;
}
