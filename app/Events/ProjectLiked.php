<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectLiked implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $slug,
        public readonly int $likesCount,
    ) {}

    public function broadcastOn(): Channel
    {
        // Public channel — no auth needed, like counter is public info
        return new Channel("project.{$this->slug}");
    }

    public function broadcastAs(): string
    {
        return 'like.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'likes_count' => $this->likesCount,
        ];
    }
}