<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $quiz = Quiz::first();

    Question::create([
      'quiz_id' => $quiz->id,
      'question_text' => 'Как называется главный герой аниме "Наруто"?',
    ]);

    Question::create([
      'quiz_id' => $quiz->id,
      'question_text' => 'В каком городе происходит действие аниме "Тетрадь смерти"?',
    ]);
  }
}
