<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastEvent;
use Laravel\Surveyor\Analyzed\ClassResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\Contracts\Type;
use ReflectionClass;
use Spatie\StructureDiscoverer\Discover;

class BroadcastEvents extends Collector
{
    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    public function collect(): Collection
    {
        return collect(
            Discover::in(app_path())
                ->classes()
                ->implementing(ShouldBroadcast::class)
                ->get(),
        )
            ->filter()
            ->map($this->toBroadcastEvent(...));
    }

    protected function toBroadcastEvent(string $class): BroadcastEvent
    {
        $analyzed = $this->analyzer->analyze((new ReflectionClass($class))->getFileName())->result();

        $eventName = $this->resolveEventName($analyzed, $class);
        $broadcastWith = $this->resolveBroadcastWith($analyzed);

        $event = new BroadcastEvent($eventName, $class, $broadcastWith);
        $event->setFilePath($analyzed->filePath());

        return $event;
    }

    protected function resolveEventName(ClassResult $analyzed, string $class): string
    {
        if ($analyzed->hasMethod('broadcastAs')) {
            return $analyzed->getMethod('broadcastAs')->returnType()->value;
        }

        return $class;
    }

    protected function resolveBroadcastWith(ClassResult $analyzed): Type
    {
        if ($analyzed->hasMethod('broadcastWith')) {
            return $analyzed->getMethod('broadcastWith')->returnType();
        }

        return new ArrayType($analyzed->publicProperties());
    }
}
