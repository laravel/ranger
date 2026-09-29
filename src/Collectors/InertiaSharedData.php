<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Support\Collection;
use Inertia\Middleware;
use Laravel\Ranger\Components\InertiaSharedData as SharedDataComponent;
use Laravel\Surveyor\Analyzed\ClassLikeResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\BoolType;
use Laravel\Surveyor\Types\Contracts\Type as TypeContract;
use Laravel\Surveyor\Types\Type;
use Laravel\Surveyor\Types\UnionType;

class InertiaSharedData extends Collector
{
    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    /**
     * @return Collection<SharedDataComponent>
     */
    public function collect(): Collection
    {
        $discovered = $this->inventory()->classesExtending('Inertia\\Middleware');

        return collect($discovered)->map($this->processSharedData(...));
    }

    /**
     * @param  class-string<Middleware>  $class
     */
    protected function processSharedData(string $class): SharedDataComponent
    {
        $result = $this->analyzer->analyzeClass($class)->result();

        $data = new ArrayType([
            ...$this->sharedProps($result, 'share'),
            ...$this->sharedProps($result, 'shareOnce'),
        ]);

        $withAllErrors = $result->hasProperty('withAllErrors')
            && $result->getProperty('withAllErrors')->type instanceof BoolType
            && $result->getProperty('withAllErrors')->type->value === true;

        return new SharedDataComponent($data, $withAllErrors);
    }

    /**
     * @return array<string, TypeContract>
     */
    protected function sharedProps(ClassLikeResult $result, string $method): array
    {
        if (! $result->hasMethod($method)) {
            return [];
        }

        $data = $result->getMethod($method)->returnType();

        if ($data instanceof ArrayType) {
            return $data->value;
        }

        if (! $data instanceof UnionType) {
            return [];
        }

        $typesByKey = [];

        foreach ($data->types as $type) {
            if ($type instanceof ArrayType) {
                foreach ($type->value as $key => $value) {
                    $typesByKey[$key][] = $value;
                }
            }
        }

        return array_map(fn (array $types) => Type::union(...$types), $typesByKey);
    }
}
