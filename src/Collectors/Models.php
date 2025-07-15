<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelInspector;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Model as ModelComponent;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type;
use Laravel\Ranger\Util\Arrayable as UtilArrayable;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionUnionType;
use Spatie\StructureDiscoverer\Discover;

class Models extends Collector
{
    protected Collection $models;

    protected Collection $modelComponents;

    public function __construct(protected ModelInspector $inspector)
    {
        //
    }

    public function collect(): Collection
    {
        $this->models = collect(
            Discover::in(app_path())
                ->classes()
                ->extending(Model::class, User::class, Pivot::class)
                ->get()
        );

        $this->modelComponents = collect();

        $this->models->each($this->mapToModel(...));

        return $this->modelComponents;
    }

    protected function mapToModel(string $model): void
    {
        $reflection = new ReflectionClass($model);

        if (! $reflection->isInstantiable()) {
            return;
        }

        $modelComponent = new ModelComponent($model);

        $info = $this->inspector->inspect($model);

        foreach ($info['attributes'] as $attribute) {
            $prop = $this->resolveAttributeType($attribute, $model);
            $prop->nullable($attribute['nullable'] ?? false);

            $modelComponent->addAttribute($attribute['name'], $prop);
        }

        foreach ($info['relations'] as $relation) {
            if (! $this->models->contains($relation['related'])) {
                $this->models->push($relation['related']);
                $this->mapToModel($relation['related']);
            }

            $isCollection = in_array($relation['type'], [
                'HasMany',
                'HasManyThrough',
                'BelongsToMany',
                'MorphToMany',
                'MorphedByMany',
            ]);

            $modelComponent->addRelation(
                $relation['name'],
                ($isCollection)
                    ? Type::arrayShape(Type::int(), Type::string($relation['related']))
                    : Type::string($relation['related']),
            );
        }

        $this->modelComponents->push($modelComponent);
    }

    protected function resolveAttributeType(array $attribute, string $model): ResultContract
    {
        if ($attribute['cast']) {
            if ($attribute['cast'] === 'accessor') {
                return $this->resolveAccessorType($attribute, $model);
            }

            $castMapping = [
                [
                    ['json', 'encrypted:json', 'encrypted:array', 'encrypted:collection', 'array', 'encrypted:object'],
                    fn () => Type::arrayShape(Type::mixed(), Type::mixed()),
                ],
                [
                    ['timestamp', 'int', 'integer', 'float'],
                    fn () => Type::int(),
                ],
                [
                    ['attribute', 'encrypted'],
                    fn () => Type::mixed(),
                ],
                [
                    ['hashed', 'date', 'datetime', 'immutable_date', 'immutable_datetime',  'string'],
                    fn () => Type::string(),
                ],
                [
                    ['bool', 'boolean'],
                    fn () => Type::bool(),
                ],
            ];

            foreach ($castMapping as $data) {
                if (in_array($attribute['cast'], $data[0])) {
                    return $data[1]();
                }
            }

            if (class_exists($attribute['cast'])) {
                return Type::from($this->resolveClassCast($attribute));
            }

            dd($attribute['cast'], 'cast type');

            return $attribute['cast'];
        }

        $typeMapping = [
            [
                ['/^boolean(\\((0|1)\\))?/', '/^tinyint( unsigned)?(\\(\\d+\\))?$/', 'bool', 'boolean'],
                fn () => Type::bool(),
            ],
            [
                [
                    '/^(big)?serial/',
                    '/^(small|big)?int(eger)?( unsigned)?$/',
                    'real',
                    'money',
                    'double precision',
                    '/^(double|decimal|numeric)(\\(\\d+\\,\\d+\\))?/',
                    'int',
                    'integer',
                    'float',
                    'number',
                ],
                fn () => Type::int(),
            ],
            // 'Uint8Array' => ['bytea'],
            [
                [
                    'string',
                    'box',
                    'cidr',
                    'inet',
                    'line',
                    'lseg',
                    'path',
                    'time',
                    'uuid',
                    'year',
                    'point',
                    'circle',
                    'polygon',
                    'interval',
                    'datetime',
                    '/^json(b)?$/',
                    '/^date(time)?$/',
                    '/^macaddr(8)?$/',
                    '/^(long|medium)?text$/',
                    '/^(var)?char(acter)?( varying)??(\\(\\d+\\))?/',
                    '/^time(stamp)?(\\(\\d+\\))?( (with|without) time zone)?/',
                ],
                fn () => Type::string(),
            ],
        ];

        foreach ($typeMapping as $data) {
            foreach ($data[0] as $test) {
                if ($test === $attribute['type']) {
                    return $data[1]();
                }

                if (str_contains($test, '/') && preg_match($test, $attribute['type']) === 1) {
                    return $data[1]();
                }
            }
        }

        return Type::from($attribute['type']);
    }

    protected function resolveAccessorType(array $attribute, string $model): ResultContract
    {
        $accessor = $attribute['name'];

        $possibleMethods = [
            'get'.str($accessor)->studly().'Attribute',
            str($accessor)->camel(),
        ];

        foreach ($possibleMethods as $method) {
            $returnType = $this->getReturnType($model, $method);

            if ($returnType) {
                return $returnType;
            }
        }

        return Type::mixed();
    }

    protected function getReturnType(string|ReflectionClass $class, string $method): ?ResultContract
    {
        // TODO: Swap this out for the Reflector class
        $reflection = $class instanceof ReflectionClass ? $class : new ReflectionClass($class);

        if (! $reflection->hasMethod($method)) {
            return null;
        }

        $methodReflection = $reflection->getMethod($method);

        if (! $methodReflection->hasReturnType()) {
            return null;
        }

        $returnType = $methodReflection->getReturnType();

        if (! $returnType) {
            return null;
        }

        if ($returnType instanceof ReflectionUnionType) {
            return Type::union(
                ...collect($returnType->getTypes())->map($this->getFinalReturnType(...)),
            );
        }

        return $this->getFinalReturnType($returnType);
    }

    protected function getFinalReturnType(ReflectionNamedType $returnType): ?ResultContract
    {
        if (! $returnType->isBuiltin()) {
            return Type::string($returnType->getName());
        }

        return match ($returnType->getName()) {
            'int', 'float' => Type::int(),
            'string' => Type::string(),
            'bool' => Type::bool(),
            'array', 'iterable' => Type::arrayShape(Type::mixed(), Type::mixed()),
            'object' => Type::arrayShape(Type::mixed(), Type::mixed()),
            'null' => Type::null(),
            // TODO: How should we handle this
            'callable' => Type::mixed(), // '( ...args: any[] ) => any',
            default => Type::mixed(),
        };
    }

    protected function resolveClassCast(array $attribute): ResultContract
    {
        $reflection = new \ReflectionClass($attribute['cast']);
        $default = Type::string($attribute['cast']);

        if ($reflection->implementsInterface(CastsAttributes::class)) {
            return $this->getReturnType($reflection, 'get') ?? $default;
        }

        if ($reflection->implementsInterface(Arrayable::class)) {
            $arrayable = app(UtilArrayable::class)->toTypeScript($attribute['cast']);

            if (! $arrayable) {
                return $default;
            }

            dd($arrayable);

            return collect(explode(PHP_EOL, $arrayable))
                ->map(fn ($line, $i) => ($i === 0) ? $line : TypeScript::indent($line))
                ->implode(PHP_EOL);
        }

        return $default;
    }
}
