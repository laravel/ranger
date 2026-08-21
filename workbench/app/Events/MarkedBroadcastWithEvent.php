<?php

namespace App\Events;

use App\Attributes\Ignore;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MarkedBroadcastWithEvent implements ShouldBroadcast
{
    public string $keptProperty = 'value';

    #[Ignore]
    public function broadcastWith(): array
    {
        return [
            'secret' => 'value',
        ];
    }

    public function broadcastOn(): array
    {
        return [];
    }
}
