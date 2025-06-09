<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\User;

class QuizSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::first();

    Quiz::create([
      'title' => 'Тест на знание аниме',
      'description' => 'Проверьте свои знания в мире аниме!',
      'user_id' => $user->id,
      'category_id' => 1,
      'image' => 'https://placehold.co/600x400',
    ]);
  }
}
