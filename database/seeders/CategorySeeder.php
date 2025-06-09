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
      [
        'name' => 'Аниме',
        'children' => [
          ['name' => 'Сёнэн'],
          ['name' => 'Сэйнэн'],
          ['name' => 'Меха'],
        ],
      ],
      [
        'name' => 'Дорама',
        'children' => [
          ['name' => 'Корейские'],
          ['name' => 'Японские'],
        ],
      ],
      ['name' => 'Фильм'],
      ['name' => 'Новости'],
      ['name' => 'Викторины'],
    ];

    foreach ($categories as $categoryData) {
      $this->createCategory($categoryData);
    }
  }

  private function createCategory(array $data, $parent = null)
  {
    $category = Category::create([
      'name' => $data['name'],
      'slug' => Str::slug($data['name']),
      'parent_id' => $parent?->id,
    ]);

    if (!empty($data['children'])) {
      foreach ($data['children'] as $child) {
        $this->createCategory($child, $category);
      }
    }
  }
}
