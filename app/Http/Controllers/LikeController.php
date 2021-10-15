<?php

namespace App\Http\Controllers;

use App\Events\CommentLiked;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'likeable' => 'required',
            'id' => 'required',
            'liked' => 'required|boolean',
        ]);

        $class = "\App\Models\\" . ucfirst($request->get('likeable'));
        $likeable = $class::findOrFail($request->get('id'));
        $like = $likeable->like($request->get('liked'));

//        event(new CommentLiked($like));
        broadcast(new CommentLiked($like))->toOthers();

        return response()
            ->json([
                'data' => [
                    'count_like' => $likeable->count_like(),
                    'count_dislike' => $likeable->count_like(false)
                ],
                'message' => sprintf('Post %s Successfully!', $request->get('liked') ? 'Liked' : 'Dislike')
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
