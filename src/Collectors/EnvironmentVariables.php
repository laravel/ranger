<?php

namespace Laravel\Ranger\Collectors;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\EnvironmentVariable;

use function Illuminate\Filesystem\join_paths;

class EnvironmentVariables extends Collector
{
    /**
     * @return Collection<EnvironmentVariable>
     */
    public function collect(): Collection
    {
        foreach ($this->basePaths as $basePath) {
            $envPath = join_paths($basePath, '.env');

            if (! file_exists($envPath)) {
                continue;
            }

            try {
                $variables = Dotenv::parse(file_get_contents($envPath));
            } catch (InvalidFileException $e) {
                continue;
            }

            return collect($variables)
                ->map(fn ($value, $key) => $this->toComponent($key, $value))
                ->values();
        }

        return collect();
    }

    protected function toComponent(string $key, mixed $value): EnvironmentVariable
    {
        return new EnvironmentVariable($key, $this->resolveValue($value));
    }

    protected function resolveValue(mixed $value): mixed
    {
        if ($value === '' || $value === null) {
            return null;
        }

        if (is_numeric($value)) {
            return str_contains((string) $value, '.') ? (float) $value : (int) $value;
        }

        return $value;
    }
}
