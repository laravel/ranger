<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\BroadcastChannel;
use Laravel\Ranger\Support\Ignores;

class BroadcastChannels extends Collector
{
    public function __construct(protected BroadcastManager $broadcastManager)
    {
        //
    }

    /**
     * @return Collection<string, BroadcastChannel>
     */
    public function collect(): Collection
    {
        return collect($this->broadcastManager->getChannels())
            ->reject(fn ($channel) => is_string($channel) && Ignores::markedClass($channel))
            ->map(fn ($channel, $name) => new BroadcastChannel($name, $channel));
    }
}
