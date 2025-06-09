<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $category = Category::first() ?? Category::factory()->create();
    $user = User::first() ?? User::factory()->create();

    $posts = [
      'Лучшие аниме 2024 года',
      'ТОП дорам для зимы',
      'Новости индустрии: июнь 2025',
    ];

    foreach ($posts as $title) {
      Post::create([
        'title' => $title,
        'slug' => Str::slug($title),
        'content' => fake()->paragraph(8),
        'category_id' => $category->id,
        'user_id' => $user->id,
        'image' => 'https://placehold.co/600x400',
      ]);
    }
  }
}
