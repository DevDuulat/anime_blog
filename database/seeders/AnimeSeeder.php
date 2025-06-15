<?php

namespace Database\Seeders;

use App\Enums\AnimeGenre;
use App\Enums\AnimeType;
use App\Models\Anime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnimeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Anime::create([
      'title' => 'Судьба Ночь Схватки: Бесконечный Клинок',
      'slug' => Str::slug('Судьба Ночь Схватки: Бесконечный Клинок'),
      'category_id' => 1,
      'studio' => 'Лиственница',
      'release_date' => '2019-10-02',
      'type' => AnimeType::TV,
      'genres' => [
        AnimeGenre::Action->value,
        AnimeGenre::Adventure->value,
        AnimeGenre::Fantasy->value,
      ],
      'description' => 'Human inhabiting the world of Alcia is branded by a “Count” or a number written on their body...',
      'views' => 131541,
    ]);
  }
}
