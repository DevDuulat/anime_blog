<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
     public function index(Request $request)
    {
        $query = $request->input('q');

        $mediaItems = MediaItem::where('title', 'like', "%{$query}%")
            ->orWhere('slug', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        $posts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('slug', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->get();

        $posts = Post::with(['category', 'user'])
        ->withCount('comments')
          ->latest()
          ->take(5)
          ->get();

        return view('search.results', [
            'query' => $query,
            'mediaItems' => $mediaItems,
            'posts' => $posts,
        ]);
    }
}
