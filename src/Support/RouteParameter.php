<?php

namespace Laravel\Ranger\Support;

use Illuminate\Support\Reflector;
use Laravel\Surveyor\Types\Type;
use ReflectionParameter;

class RouteParameter
{
    public readonly string $placeholder;

    public readonly array $types;

    public function __construct(
        public readonly string $name,
        public readonly bool $optional,
        public ?string $key,
        public readonly ?string $default,
        public readonly ?ReflectionParameter $bound = null,
    ) {
        $this->placeholder = $optional ? "{{$name}?}" : "{{$name}}";
        $this->types = $this->resolveTypes();
    }

    protected function resolveTypes(): array
    {
        $default = [Type::string(), Type::number()];

        if (! $this->bound) {
            return $default;
        }

        $model = Reflector::getParameterClassName($this->bound);

        if (! $model) {
            return $default;
        }

        [$type, $this->key] = RouteBindingResolver::resolveTypeAndKey($model, $this->key);

        if (! $type) {
            return $default;
        }

        return [$type];
    }
}
