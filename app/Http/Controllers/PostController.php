<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('permission:show posts', ['only' => ['index']]);
        $this->middleware('permission:add posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit posts', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete posts', ['only' => ['destroy']]);
    }


    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('posts.index', compact(
            ['posts']
        ));
    }

    public function create()
    {
        return view ('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text'  => 'required|string'
        ]);

        Post::create($request->all());

        return redirect()->back()->with('status', 'Post has been created');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact([
            'post',
        ]));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text'  => 'required|string'
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->back()->with('status', 'Post has been updated');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->back()->with('status', 'Post has been deleted');
    }


}
