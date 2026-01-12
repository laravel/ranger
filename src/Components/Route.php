<?php

namespace Laravel\Ranger\Components;

use Closure;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Ranger\Support\HasPaths;
use Laravel\Ranger\Support\RouteParameter;
use Laravel\Ranger\Support\Verb;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use ReflectionClass;

class Route
{
    use HasPaths;

    protected array $possibleResponses = [];

    protected ?Validator $requestValidator = null;

    protected ?Collection $parameters = null;

    protected ?string $resolvedUri = null;

    protected ?string $resolvedControllerPath = null;

    protected ?int $methodLineNumber = null;

    public function __construct(
        protected BaseRoute $base,
        protected Collection $paramDefaults,
        protected ?string $forcedScheme,
        protected ?string $forcedRoot
    ) {
        //
    }

    public function hasController(): bool
    {
        return $this->base->getControllerClass() !== null;
    }

    public function dotNamespace(): string
    {
        return str_replace('\\', '.', Str::chopStart($this->controller(), '\\'));
    }

    public function hasInvokableController(): bool
    {
        return $this->actionName() === $this->base->getActionMethod();
    }

    public function actionName(): string
    {
        return $this->base->getActionName();
    }

    public function controller(): string
    {
        return $this->hasInvokableController()
            ? Str::start($this->actionName(), '\\')
            : Str::start($this->base->getControllerClass(), '\\');
    }

    public function method(): string
    {
        return $this->hasInvokableController()
            ? '__invoke'
            : $this->base->getActionMethod();
    }

    public function parameters(): Collection
    {
        return $this->parameters ??= $this->resolveParameters();
    }

    public function possibleResponses(): array
    {
        return $this->possibleResponses;
    }

    public function requestValidator(): ?Validator
    {
        return $this->requestValidator;
    }

    public function verbs(): Collection
    {
        return collect($this->base->methods())->mapInto(Verb::class);
    }

    public function setPossibleResponses(array $possibleResponses): void
    {
        $this->possibleResponses = array_unique($possibleResponses, SORT_REGULAR);
    }

    public function setRequestValidator(Validator $requestValidator): void
    {
        $this->requestValidator = $requestValidator;
    }

    public function uri(): string
    {
        return $this->resolvedUri ??= $this->resolveUri();
    }

    public function scheme(): ?string
    {
        return match (true) {
            $this->base->httpOnly() => 'http://',
            $this->base->httpsOnly() => 'https://',
            default => $this->forcedScheme,
        };
    }

    public function domain(): ?string
    {
        if ($this->base->getDomain()) {
            return $this->base->getDomain();
        }

        if ($this->forcedRoot) {
            return str_replace(['http://', 'https://'], '', $this->forcedRoot);
        }

        return null;
    }

    public function name(): ?string
    {
        $name = $this->base->getName();

        if (! $name || Str::endsWith($name, '.') || Str::startsWith($name, 'generated::')) {
            return null;
        }

        if (str_contains($name, '::')) {
            return 'namespaced.'.str_replace('::', '.', $name);
        }

        return $name;
    }

    public function controllerPath(): string
    {
        return $this->resolvedControllerPath ??= $this->resolveControllerPath();
    }

    public function methodLineNumber(): int
    {
        return $this->methodLineNumber ??= $this->resolveMethodLineNumber();
    }

    protected function resolveMethodLineNumber(): int
    {
        $controller = $this->controller();

        if ($controller === '\\Closure') {
            return (new ReflectionClosure($this->closure()))->getStartLine();
        }

        if (! class_exists($controller)) {
            return 0;
        }

        $reflection = new ReflectionClass($controller);

        if ($reflection->hasMethod($this->method())) {
            return $reflection->getMethod($this->method())->getStartLine();
        }

        return 0;
    }

    protected function resolveControllerPath(): string
    {
        $controller = $this->controller();

        if ($controller === '\\Closure') {
            $path = (new ReflectionClosure($this->closure()))->getFileName();

            if (str_contains($path, 'laravel-serializable-closure')) {
                return '[serialized-closure]';
            }

            return $path;
        }

        if (! class_exists($controller)) {
            return '[unknown]';
        }

        return (new ReflectionClass($controller))->getFileName();
    }

    protected function resolveUri(): string
    {
        $defaultParams = $this->paramDefaults->mapWithKeys(fn ($value, $key) => ["{{$key}}" => "{{$key}?}"]);

        $scheme = $this->scheme() ?? '//';

        return str($this->base->uri)
            ->start('/')
            ->when($this->domain() !== null, fn ($uri) => $uri->prepend("{$scheme}{$this->domain()}"))
            ->replace($defaultParams->keys()->toArray(), $defaultParams->values()->toArray())
            ->toString();
    }

    protected function resolveParameters(): Collection
    {
        $optionalParameters = collect($this->base->toSymfonyRoute()->getDefaults());
        $signatureParams = collect($this->base->signatureParameters(UrlRoutable::class));

        return collect($this->base->parameterNames())->map(fn ($name) => new RouteParameter(
            $name,
            $optionalParameters->has($name) || $this->paramDefaults->has($name),
            $this->base->bindingFieldFor($name),
            $this->paramDefaults->get($name),
            $signatureParams->first(fn ($p) => $p->getName() === $name),
        ));
    }

    protected function relativePath(string $path)
    {
        foreach ($this->basePaths as $basePath) {
            if (str_contains($path, $basePath)) {
                return str($path)->replace($basePath, '')->ltrim(DIRECTORY_SEPARATOR)->replace(DIRECTORY_SEPARATOR, '/')->toString();
            }
        }

        return str($path)->ltrim(DIRECTORY_SEPARATOR)->replace(DIRECTORY_SEPARATOR, '/')->toString();
    }

    protected function closure(): Closure
    {
        return RouteAction::containsSerializedClosure($this->base->getAction())
            ? unserialize($this->base->getAction('uses'))->getClosure()
            : $this->base->getAction('uses');
    }
}
