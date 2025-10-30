<?php

namespace Laravel\Ranger\Concerns;

trait HasFilePath
{
    protected string $filepath;

    public function setFilePath(string $filepath): static
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function filePath(): string
    {
        return $this->filepath;
    }
}
