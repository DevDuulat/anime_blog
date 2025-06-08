<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\Question;

class AnswerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $question1 = Question::where('question_text', 'like', '%Наруто%')->first();
    $question2 = Question::where('question_text', 'like', '%Тетрадь смерти%')->first();

    Answer::insert([
      [
        'question_id' => $question1->id,
        'answer_text' => 'Наруто Узумаки',
        'is_correct' => true,
      ],
      [
        'question_id' => $question1->id,
        'answer_text' => 'Саске Учиха',
        'is_correct' => false,
      ],
      [
        'question_id' => $question2->id,
        'answer_text' => 'Токио',
        'is_correct' => true,
      ],
      [
        'question_id' => $question2->id,
        'answer_text' => 'Осака',
        'is_correct' => false,
      ],
    ]);
  }
}
