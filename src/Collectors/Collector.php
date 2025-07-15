<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Support\Collection;

abstract class Collector
{
    protected Collection $cached;

    public function run(array $callbacks): void
    {
        $componentCallbacks = collect($callbacks);

        $this->getCollection()->each(fn ($item) => $componentCallbacks->each(fn ($callback) => $callback($item)));
    }

    public function runOnCollection(array $callbacks): void
    {
        collect($callbacks)->each(fn ($callback) => $callback($this->getCollection()));
    }

    public function getCollection(): Collection
    {
        $this->cached ??= $this->collect();

        return $this->cached;
    }

    abstract public function collect(): Collection;
}
