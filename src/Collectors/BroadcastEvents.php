<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastEvent;
use Spatie\StructureDiscoverer\Discover;

class BroadcastEvents extends Collector
{
    public function collect(): Collection
    {
        return collect(
            Discover::in(app_path())
                ->classes()
                ->implementing(ShouldBroadcast::class)
                ->get(),
        )
            ->filter()
            ->map(fn (string $class) => new BroadcastEvent($class));
    }
}
