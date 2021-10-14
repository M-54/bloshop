<article class="blog-post">
    @if($showImage)
        <img src="{{ \Illuminate\Support\Facades\Storage::url(optional($post->main_image)->url) }}"
             alt="{{ optional($post->main_image)->name }}"
             class="img-fluid mb-5">
    @endif
    <h2 class="blog-post-title">
        <a href="{{ route('posts.show', $post) }}" class="link-dark text-decoration-none">
            {{ $post->title }}
        </a>
    </h2>
    <p class="blog-post-meta">{{ $post->created_at }} <a href="#">{{ $post->author->name }}</a></p>

    {{ $post->content }}
</article>
