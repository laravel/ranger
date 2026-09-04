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
        $analyzed = $this->analyzer->analyzeClass($class)->result();

        if ($analyzed->isIgnored() || Ignores::markedClass($class)) {
            return null;
        }

        $eventName = $this->resolveEventName($analyzed, $class);
        $broadcastWith = $this->resolveBroadcastWith($analyzed);

        $event = new BroadcastEvent($eventName, $class, $broadcastWith);
        $event->setFilePath($analyzed->filePath());

        return $event;
    }

    /**
     * @param  class-string<ShouldBroadcast>  $class
     */
    protected function resolveEventName(ClassLikeResult $analyzed, string $class): string
    {
        if ($analyzed->hasMethod('broadcastAs')) {
            $returnType = $analyzed->getMethod('broadcastAs')->returnType();

            // A broadcastAs() that builds its name at runtime has no literal to
            // read, so the class name stays the best answer available.
            if ($returnType instanceof StringType && $returnType->value !== null) {
                return $returnType->value;
            }
        }

        return $class;
    }

    protected function resolveBroadcastWith(ClassLikeResult $analyzed): Type
    {
        if ($analyzed->hasMethod('broadcastWith')) {
            return $analyzed->getMethod('broadcastWith')->returnType();
        }

        return new ArrayType(
            collect($analyzed->publicProperties())->mapWithKeys(
                fn ($prop) => [$prop->name => $prop->type],
            )->all(),
        );
    }
}
