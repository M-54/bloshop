<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostComponent extends Component
{

    public $post;
    public $showImage;

    /**
     * Create a new component instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->showImage = request()->routeIs('posts.*');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post')
            ->with('post', $this->post);
    }
}
