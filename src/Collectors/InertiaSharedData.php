<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Support\Collection;
use Laravel\Ranger\Components\InertiaSharedData as SharedDataComponent;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\Type;
use Laravel\Surveyor\Types\UnionType;
use ReflectionClass;
use Spatie\StructureDiscoverer\Discover;

class InertiaSharedData extends Collector
{
    protected array $parsed = [];

    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    public function collect(): Collection
    {
        return collect(
            Discover::in(app_path())
                ->classes()
                ->extending('Inertia\\Middleware')
                ->get()
        )->map($this->processSharedData(...));
    }

    protected function processSharedData(string $class): SharedDataComponent
    {
        $result = $this->analyzer->analyze((new ReflectionClass($class))->getFileName())->result();

        if (! $result->hasMethod('share')) {
            return new SharedDataComponent(new ArrayType([]));
        }

        $data = $result->getMethod('share')->returnType();

        if ($data instanceof UnionType) {
            $finalArray = [];

            foreach ($data->types as $type) {
                if ($type instanceof ArrayType) {
                    foreach ($type->value as $key => $value) {
                        $finalArray[$key] ??= [];
                        $finalArray[$key][] = $value;
                    }
                } else {
                    dd('Unexpected type in Inertia shared data: '.get_class($type));
                }
            }

            foreach ($finalArray as $key => $values) {
                $finalArray[$key] = Type::union(...$values);
            }

            $data = new ArrayType($finalArray);
        }

        return new SharedDataComponent($data);
    }
}
