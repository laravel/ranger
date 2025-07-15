<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements ShouldBroadcast, ShouldDispatchAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(protected Post $post)
    {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('posts'),
            new PrivateChannel('users.'.$this->post->user_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'post' => $this->post->only(['id', 'title', 'created_at']),
            'author' => $this->post->user->only(['id', 'name']),
        ];
    }
}
