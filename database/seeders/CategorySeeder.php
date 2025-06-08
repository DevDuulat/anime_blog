<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      'Аниме',
      'Дорама',
      'Фильм',
      'Новости',
      'Викторины',
    ];

    foreach ($categories as $name) {
      Category::create([
        'name' => $name,
        'slug' => Str::slug($name),
      ]);
    }
  }
}
