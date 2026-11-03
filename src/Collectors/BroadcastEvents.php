<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastEvent;
use Laravel\Ranger\Support\Ignores;
use Laravel\Surveyor\Analyzed\ClassLikeResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\Contracts\Type;
use Laravel\Surveyor\Types\StringType;
use Laravel\Surveyor\Types\Type as Types;
use ReflectionClass;
use ReflectionMethod;

class BroadcastEvents extends Collector
{
    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    /**
     * @return Collection<BroadcastEvent>
     */
    public function collect(): Collection
    {
        $discovered = $this->inventory()->classesImplementing(ShouldBroadcast::class, ShouldBroadcastNow::class);

        return collect($discovered)
            ->filter()
            ->map($this->toBroadcastEvent(...))
            ->filter()
            ->values();
    }

    /**
     * @param  class-string<ShouldBroadcast>  $class
     */
    protected function toBroadcastEvent(string $class): ?BroadcastEvent
    {
        // An abstract base is never dispatched itself, so it has no name or payload on the wire.
        if (! (new ReflectionClass($class))->isInstantiable()) {
            return null;
        }

        $analyzed = $this->analyzer->analyzeClass($class)->result();

        if ($analyzed->isIgnored() || Ignores::markedClass($class)) {
            return null;
        }

        $eventName = $this->resolveEventName($class);
        $broadcastWith = $this->resolveBroadcastWith($analyzed, $class);

        $event = new BroadcastEvent($eventName, $class, $broadcastWith);
        $event->setFilePath($analyzed->filePath());

        return $event;
    }

    /**
     * @param  class-string<ShouldBroadcast>  $class
     */
    protected function resolveEventName(string $class): string
    {
        $broadcastAs = $this->declaringResult($class, 'broadcastAs')?->getMethod('broadcastAs')->returnType();

        // A broadcastAs() that builds its name at runtime has no literal to
        // read, so the class name stays the best answer available.
        if ($broadcastAs instanceof StringType && $broadcastAs->value !== null) {
            return $broadcastAs->value;
        }

        return $class;
    }

    /**
     * @param  class-string<ShouldBroadcast>  $class
     */
    protected function resolveBroadcastWith(ClassLikeResult $analyzed, string $class): Type
    {
        $declaring = $this->declaringResult($class, 'broadcastWith');

        if ($declaring === null) {
            return new ArrayType(
                collect($analyzed->publicProperties())->mapWithKeys(
                    fn ($prop) => [$prop->name => $prop->type],
                )->all(),
            );
        }

        // An inherited broadcastWith() was analyzed against its own class. If
        // the event overrides anything that class declares, the payload it
        // builds through $this can differ, so nothing specific is promised.
        if ($declaring->name() !== $class && $this->overridesMethodsOf($class, $declaring->name())) {
            return Types::mixed();
        }

        return $declaring->getMethod('broadcastWith')->returnType();
    }

    /**
     * The analyzed class that declares the method the event actually runs.
     */
    protected function declaringResult(string $class, string $method): ?ClassLikeResult
    {
        if (! method_exists($class, $method)) {
            return null;
        }

        $declaring = (new ReflectionMethod($class, $method))->getDeclaringClass();

        if ($declaring->isInterface() || $declaring->getFileName() === false) {
            return null;
        }

        $result = $this->analyzer->analyzeClass($declaring->getName())->result();

        return $result?->hasMethod($method) ? $result : null;
    }

    protected function overridesMethodsOf(string $class, string $ancestor): bool
    {
        $ancestorMethods = collect((new ReflectionClass($ancestor))->getMethods())
            ->reject(fn (ReflectionMethod $method) => $method->isConstructor())
            ->map(fn (ReflectionMethod $method) => $method->getName());

        return collect((new ReflectionClass($class))->getMethods())
            ->filter(fn (ReflectionMethod $method) => $method->getDeclaringClass()->getName() !== $ancestor
                && is_subclass_of($method->getDeclaringClass()->getName(), $ancestor))
            ->contains(fn (ReflectionMethod $method) => $ancestorMethods->contains($method->getName()));
    }
}
