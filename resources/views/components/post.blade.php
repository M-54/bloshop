<article class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at }} <a href="#">{{ $post->author->name }}</a></p>

    {{ $post->content }}
</article>
