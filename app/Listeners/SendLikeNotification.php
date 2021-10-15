<?php

namespace App\Listeners;

use App\Events\CommentLiked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLikeNotification
{

    /**
     * Handle the event.
     *
     * @param  CommentLiked  $event
     * @return void
     */
    public function handle(CommentLiked $event)
    {
        info("User " . $event->like->user->id . " Like");
    }
}
