<?php

namespace App\Traits;

trait Likeable
{
    public function like($like = true, $user = null)
    {
        return $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ], [
            'liked' => $like,
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function count_like($liked = true)
    {
        return $this->likes()->where('liked', $liked)->count();
    }
}
