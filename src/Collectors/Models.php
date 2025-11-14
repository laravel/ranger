<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelInspector;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Model as ModelComponent;
use Laravel\Surveyor\Analyzer\Analyzer;
use Spatie\StructureDiscoverer\Discover;

class Models extends Collector
{
    protected Collection $models;

    protected Collection $modelComponents;

    public function __construct(
        protected ModelInspector $inspector,
        protected Analyzer $analyzer,
    ) {
        $this->modelComponents = collect();
    }

    public function collect(): Collection
    {
        $this->models = collect(
            Discover::in(app_path())
                ->classes()
                ->extending(Model::class, User::class, Pivot::class)
                ->get()
        );

        $this->models->each($this->toComponent(...));

        return $this->modelComponents;
    }

    public function get(string $model): ?ModelComponent
    {
        return $this->getCollection()->first(fn (ModelComponent $component) => $component->name === $model);
    }

    protected function toComponent(string $model): void
    {
        $result = $this->analyzer->analyzeClass($model)->result();

        if ($result === null) {
            return;
        }

        $modelComponent = new ModelComponent($model);

        foreach ($result->publicProperties() as $property) {
            if ($property->modelAttribute || $property->fromDocBlock) {
                $modelComponent->addAttribute($property->name, $property->type);
            }
        }

        foreach ($result->publicMethods() as $method) {
            if ($method->isModelRelation()) {
                $returnType = $method->returnType();

                if (! $this->modelComponents->has($returnType->value)) {
                    $this->toComponent($returnType->value);
                }

                $modelComponent->addRelation($method->name(), $returnType);
            }
        }

        $this->modelComponents->push($modelComponent);
    }
}
