<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use App\Models\Post;

class HomeController extends Controller
{
  public function index()
  {
      $mediaQuery = MediaItem::with('category');

      $trendingMedia = (clone $mediaQuery)
          ->orderBy('views', 'desc')
          ->take(3)
          ->get();

      $popularMedia = (clone $mediaQuery)
          ->orderBy('views', 'desc')
          ->skip(3)
          ->take(4)
          ->get();

      $recentMedia = (clone $mediaQuery)
          ->latest()
          ->take(2)
          ->get();

      $posts = Post::with(['category', 'user'])
          ->withCount('comments')
          ->latest()
          ->take(5)
          ->get();



      return view('home', compact(
          'trendingMedia',
          'popularMedia',
          'recentMedia',
          'posts'
      ));
  }

}
