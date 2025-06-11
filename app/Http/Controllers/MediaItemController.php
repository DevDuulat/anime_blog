<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MediaItem;
use App\Models\Post;
use Illuminate\Http\Request;

class MediaItemController extends Controller
{
    //

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');

        $mediaItems = MediaItem::orderBy($sort, 'desc')->paginate(12);

        $posts = Post::with(['category', 'user'])
            ->withCount('comments')
            ->latest()
            ->take(5)
            ->get();

        return view('media.index', compact('mediaItems', 'posts'));
    }


    public function byCategory(Request $request, $slug)
    {
        $category = Category::with('children')->where('slug', $slug)->firstOrFail();

        $categoryIds = collect([$category->id])->merge(
            $category->children->pluck('id')
        );

        $sort = $request->input('sort', 'created_at');

        $mediaItems = MediaItem::whereIn('category_id', $categoryIds)
            ->orderBy($sort, 'desc')
            ->paginate(12);

        $posts = Post::with(['category', 'user'])
        ->withCount('comments')
          ->latest()
          ->take(5)
          ->get();

        return view('media.index', compact('mediaItems', 'category', 'posts'));
    }

    public function show($slug, Request $request)
    {
        $mediaItem = MediaItem::with(['episodes', 'comments.user'])->where('slug', $slug)->firstOrFail();

        $episodeNumber = $request->query('episode');
        $currentEpisode = $episodeNumber
            ? $mediaItem->episodes->where('episode_number', $episodeNumber)->first()
            : $mediaItem->episodes->sortBy('episode_number')->first();

        return view('media.show', compact('mediaItem', 'currentEpisode'));
    }

     public function mediaDetail($slug, Request $request)
      {
          $mediaItem = MediaItem::with(['episodes', 'comments.user'])->where('slug', $slug)->firstOrFail();
          $episodeNumber = $request->query('episode');
          $currentEpisode = $episodeNumber
              ? $mediaItem->episodes->where('episode_number', $episodeNumber)->first()
              : $mediaItem->episodes->sortBy('episode_number')->first();
          $posts = Post::with(['category', 'user'])
            ->withCount('comments')
            ->latest()
            ->take(5)
            ->get();

          return view('media.detail', compact('mediaItem', 'currentEpisode', 'posts'));
      }
}
