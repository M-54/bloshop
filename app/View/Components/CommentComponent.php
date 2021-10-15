<?php

namespace App\View\Components;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\View\Component;

class CommentComponent extends Component
{
    public $comment;
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment-component');
    }
}
