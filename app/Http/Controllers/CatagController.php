<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CatagController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate();
        $tags = Tag::latest()->paginate();

        return view('catag.index', compact('categories', 'tags'));
    }

    public function create()
    {
        return view('catag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                Rule::in(['category', 'tag'])
            ],
            'title' => 'required',
        ]);

        if ($request->get('type') == 'category') {
            Category::create($request->all());

            return redirect()
                ->route('catag.index')
                ->with('message', 'Category created successfully');
        } else {
            Tag::create($request->all());

            return redirect()
                ->route('catag.index')
                ->with('message', 'Tag created successfully');
        }
    }
}
