<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastEvent;
use Laravel\Surveyor\Analyzed\ClassLikeResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\Contracts\Type;

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
            ->map($this->toBroadcastEvent(...));
    }

    /**
     * @param  class-string<ShouldBroadcast>  $class
     */
    protected function toBroadcastEvent(string $class): BroadcastEvent
    {
        $analyzed = $this->analyzer->analyzeClass($class)->result();

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
            return $analyzed->getMethod('broadcastAs')->returnType()->value;
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
