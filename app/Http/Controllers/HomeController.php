<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Post;

class HomeController extends Controller
{
  public function index()
  {
    $animeQuery = Anime::with('category');

    $trendingAnime = (clone $animeQuery)
      ->orderBy('views', 'desc')
      ->take(3)
      ->get();

    $popularAnime = (clone $animeQuery)
      ->orderBy('views', 'desc')
      ->skip(3)
      ->take(4)
      ->get();

    $recentAnime = (clone $animeQuery)
      ->latest()
      ->take(2)
      ->get();

    $blogPosts = Post::with(['category', 'user'])
      ->latest()
      ->take(5)
      ->get();

    return view('home', compact(
      'trendingAnime',
      'popularAnime',
      'recentAnime',
      'blogPosts'
    ));
  }
}
