<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Ranger\Components\Model as ModelComponent;
use Laravel\Surveyor\Analyzed\ClassResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\BoolType;
use Laravel\Surveyor\Types\ClassType;
use Laravel\Surveyor\Types\Contracts\Type as SurveyorTypeContract;
use Laravel\Surveyor\Types\StringType;
use Laravel\Surveyor\Types\Type;
use Spatie\StructureDiscoverer\Discover;

class Models extends Collector
{
    protected Collection $modelComponents;

    public function __construct(protected Analyzer $analyzer)
    {
        $this->modelComponents = collect();
    }

    /**
     * @return Collection<ModelComponent>
     */
    public function collect(): Collection
    {
        $discovered = Discover::in(...$this->appPaths)
            ->classes()
            ->extending(Model::class, User::class, Pivot::class)
            ->get();

        foreach ($discovered as $model) {
            $this->toComponent($model);
        }

        return $this->modelComponents->values();
    }

    /**
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $model
     */
    public function get(string $model): ?ModelComponent
    {
        return $this->getCollection()->first(
            fn (ModelComponent $component) => $component->name === $model,
        );
    }

    /**
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $model
     */
    protected function toComponent(string $model): void
    {
        $result = $this->analyzer->analyzeClass($model)->result();

        if ($result === null) {
            return;
        }

        $modelComponent = new ModelComponent($model);

        $eagerLoadRelations = $this->gatherEagerLoadRelations($result);
        $modelComponent->setSnakeCaseAttributes($this->shouldSnakeCase($result));

        $this->modelComponents->offsetSet($modelComponent->name, $modelComponent);

        foreach ($result->publicProperties() as $property) {
            if ($property->modelAttribute || $property->fromDocBlock) {
                $modelComponent->addAttribute($property->name, $property->type);
            }
        }

        foreach ($result->publicMethods() as $method) {
            if ($method->isModelRelation()) {
                $returnType = $this->resolveReturnType(
                    $method->returnType(),
                    in_array($method->name(), $eagerLoadRelations)
                        || in_array(Str::snake($method->name()), $eagerLoadRelations),
                );

                if ($returnType === null) {
                    continue;
                }

                $modelComponent->addRelation($method->name(), $returnType);
            }
        }
    }

    protected function gatherEagerLoadRelations(ClassResult $result): array
    {
        $propertyName = 'with';

        if (! $result->hasProperty($propertyName) || ! $result->getProperty($propertyName)->type instanceof ArrayType) {
            return [];
        }

        $eagerLoadRelations = [];

        foreach ($result->getProperty($propertyName)->type->value as $relation) {
            if ($relation instanceof StringType) {
                $eagerLoadRelations[] = $relation->value;
            }
        }

        return $eagerLoadRelations;
    }

    protected function shouldSnakeCase(ClassResult $result): bool
    {
        $propertyName = 'snakeAttributes';

        if (! $result->hasProperty($propertyName) || ! $result->getProperty($propertyName)->type instanceof BoolType) {
            return true;
        }

        return $result->getProperty($propertyName)->type->value;
    }

    protected function resolveReturnType(SurveyorTypeContract $type, bool $required): ?SurveyorTypeContract
    {
        if (! $type instanceof ClassType) {
            return null;
        }

        $relatedModel = $type->genericTypes()['TRelatedModel'] ?? null;

        if (! $relatedModel || ! $relatedModel instanceof ClassType) {
            return null;
        }

        if (! $this->modelComponents->offsetExists($relatedModel->value)) {
            $this->toComponent($relatedModel->value);
        }

        $collectionRelations = [
            BelongsToMany::class,
            HasMany::class,
            HasManyThrough::class,
            MorphMany::class,
            MorphToMany::class,
        ];

        if (in_array($type->value, $collectionRelations)) {
            return (new ArrayType([$relatedModel]))->required($required);
        }

        $maybeCollectionRelation = [
            MorphOneOrMany::class,
            HasOneOrMany::class,
            HasOneOrManyThrough::class,
        ];

        if (in_array($type->value, $maybeCollectionRelation)) {
            return Type::union(new ClassType($type->value), new ArrayType([$relatedModel]))->nullable()->required($required);
        }

        return $relatedModel->nullable()->required($required);
    }
}
