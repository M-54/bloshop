<article class="blog-post">
    @if($showImage)
        @if($post->iamges_count == 1)
            <div class="ratio ratio-16x9 mb-5">
                <img src="{{ \Illuminate\Support\Facades\Storage::url(optional($post->main_image)->url) }}"
                     alt="{{ optional($post->main_image)->name }}"
                     class="img-fluid" style="object-fit: cover">
            </div>
        @else
            <div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($post->images as $image)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image->url) }}" class="d-block w-100"
                                 alt="{{ $image->name }}">
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
    @endif
    <h2 class="blog-post-title">
        <a href="{{ route('posts.show', $post) }}" class="link-dark text-decoration-none">
            {{ $post->title }}
        </a>
    </h2>
    <p class="blog-post-meta">{{ $post->created_at }} <a href="#">{{ $post->author->name }}</a></p>

    {{ $post->content }}
</article>
