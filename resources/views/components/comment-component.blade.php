<div class="mx-4 p-2" style="border-left: 1px solid #ccc;">
    <div class="d-flex flex-row justify-content-between">
        <div class="d-flex align-items-center mb-4" id="comment_{{ $comment->id }}">
            <div class="flex-shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}"
                     alt="{{ $comment->user->name }}">
            </div>
            <div class="flex-grow-1 ms-3">
                <h3 class="d-block">{{ $comment->user->name }} says:</h3>
                {{ $comment->content }}
            </div>
        </div>

        <div id="comment_like_{{ $comment->id }}" class="d-flex flex-column">
            <button class="btn btn-primary btn-sm like" onclick="comment_like({{ $comment->id }})">
                <i class="bi bi-hand-thumbs-up"></i>
                (<span>{{ $comment->count_like() }}</span>)
            </button>
            <button class="btn btn-danger btn-sm dislike" onclick="comment_like({{ $comment->id }}, false)">
                <i class="bi bi-hand-thumbs-down"></i>
                (<span>{{ $comment->count_like(false) }}</span>)
            </button>
        </div>
    </div>

    @foreach($comment->replies as $reply)
        <x-comment-component :comment="$reply" :post="$post" class="bg-white"></x-comment-component>
    @endforeach

    <button class="btn btn-primary my-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#reply_comments_{{ $comment->id }}"
            aria-expanded="false" aria-controls="reply_comments_{{ $comment->id }}">
        Reply
    </button>

    <div class="collapse" id="reply_comments_{{ $comment->id }}">
        <form action="{{ route('comments.store') }}" method="post" class="mb-5">
            @csrf

            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

            <div class="mb-3">
                <label for="comment" class="form-label">Your Comment:</label>
                <textarea class="form-control" name="content" id="comment" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
