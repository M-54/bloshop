<?php

namespace App\Events;

use App\Models\Like;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Like
     */
    public $like;
    public $count;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
        $this->count = [
            'count_like' => $like->likeable->count_like(),
            'count_dislike' => $like->likeable->count_like(false)
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('comment-like');
    }
}
