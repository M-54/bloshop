<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post', [
            'except' => ['show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = request('status');

        $key = 'posts_' . auth()->id();

//        if (Cache::has($key))
//            $posts = Cache::get($key);
//        else {
//            if (auth()->user()->hasRole('super-admin'))
//                $posts = Post::query();
//            else
//                $posts = auth()->user()->posts();
//
//            $posts = $posts->where('title', 'LIKE', "%" . request('title') . "%")
//                //->when(request('status') != 'all', fn($query) => $query->where('status', request('status')))
//                /*->when(request('status') != 'all', function ($query) use ($status) {
//                    $query->where('status', $status);
//                })*/
//                ->when(request('status') != 'all', function ($query) use ($status) {
//                    $query->scopes($status);
//                })
//                ->latest()->paginate();
//
//            Cache::put($key, $posts);
//        }

        $posts = Cache::rememberForever($key, function () use ($status) {
            if (auth()->user()->hasRole('super-admin'))
                $posts = Post::query();
            else
                $posts = auth()->user()->posts();

            $posts = $posts->where('title', 'LIKE', "%" . request('title') . "%")
                //->when(request('status') != 'all', fn($query) => $query->where('status', request('status')))
                /*->when(request('status') != 'all', function ($query) use ($status) {
                    $query->where('status', $status);
                })*/
                ->when(request('status') != 'all', function ($query) use ($status) {
                    $query->scopes($status);
                })
                ->latest()->paginate();

            return $posts;
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        #$request->request->set('author_id', auth()->id());

        $validated = $request->validated();

        $post = DB::transaction(function () use ($validated, $request) {
            $post = auth()->user()->posts()->create($validated);

            if (isset($validated['category_id']))
                $post->categories()->sync($validated['category_id']);

            if (isset($validated['tag_id']))
                $post->tags()->sync($validated['tag_id']);

            $path = $request->file('image')->storePublicly('posts');
            $post->images()->create([
                'url' => $path,
                'name' => $request->file('image')->getClientOriginalName(),
            ]);

            foreach ($request->file('gallery') as $file) {
                $path = $file->storePublicly("posts/gallery/$post->id");
                $post->images()->create([
                    'url' => $path,
                    'name' => $file->getClientOriginalName(),
                ]);
            }

            return $post;
        });

        Cache::forget('posts_' . auth()->id());

        return redirect()
            ->route('posts.index')
            ->with('message', "Post $post->title Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->status == 'draft')
            return abort(404);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        return redirect()
            ->route('posts.index')
            ->with('message', "Post $post->title Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
