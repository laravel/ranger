<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastChannel;

class BroadcastChannels extends Collector
{
    public function __construct(protected BroadcastManager $broadcaster)
    {
        //
    }

    public function collect(): Collection
    {
        return collect($this->broadcaster->getChannels())
            ->map(fn ($channel, $name) => new BroadcastChannel($name, $channel));
    }
}
