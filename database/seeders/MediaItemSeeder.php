<?php

namespace Database\Seeders;

use App\Enums\MediaGenre;
use App\Enums\MediaType;
use App\Models\MediaItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MediaItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         MediaItem::create([
            'title' => 'Судьба: Ночь Схватки — Бесконечный Клинок',
            'slug' => Str::slug('Судьба: Ночь Схватки — Бесконечный Клинок'),
            'category_id' => 1,
            'studio' => 'Лиственница',
            'release_date' => '2019-10-02',
            'type' => MediaType::TV, // либо просто строка 'tv'
            'genres' => [
                MediaGenre::Action->value,
                MediaGenre::Adventure->value,
                MediaGenre::Fantasy->value,
            ],
            'description' => 'Human inhabiting the world of Alcia is branded by a “Count” or a number written on their body...',
            'views' => 131541,
            'image' => 'https://placehold.co/600x400',
        ]);
    }
}
