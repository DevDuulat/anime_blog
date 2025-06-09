<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::with(['category', 'user', 'comments'])
            ->where('slug', $slug)
            ->firstOrFail();

        $prev = Post::where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->first();

        $next = Post::where('id', '>', $post->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('posts.show', compact('post', 'prev', 'next'));
    }

}
