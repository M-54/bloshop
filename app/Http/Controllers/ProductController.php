<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()->products()->paginate();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = DB::transaction(function () use ($request) {
            $product = auth()->user()->products()->create($request->all());

            if (isset($validated['category_id']))
                $product->categories()->sync($validated['category_id']);

            if (isset($validated['tag_id']))
                $product->tags()->sync($validated['tag_id']);

            $path = $request->file('image')->storePublicly('products');
            $product->images()->create([
                'url' => $path,
                'name' => $request->file('image')->getClientOriginalName(),
            ]);

            foreach ($request->file('gallery') as $file) {
                $path = $file->storePublicly("posts/gallery/$product->id");
                $product->images()->create([
                    'url' => $path,
                    'name' => $file->getClientOriginalName(),
                ]);
            }

            return $product;
        });

        return redirect()
            ->route('products.index')
            ->with('message', "Post $product->title Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
