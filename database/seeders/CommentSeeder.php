<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::first();
    $posts = Post::take(3)->get();

    foreach ($posts as $post) {
      Comment::create([
        'user_id' => $user->id,
        'content' => 'Это комментарий к посту "' . $post->title . '"',
        'commentable_id' => $post->id,
        'commentable_type' => Post::class,
      ]);
    }
  }
}
