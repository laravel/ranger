<?php

namespace App\Events;

use App\Attributes\Ignore;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

#[Ignore]
class IgnoredEvent implements ShouldBroadcast
{
    public string $secret = 'value';

    public function broadcastOn(): array
    {
        return [];
    }
}
