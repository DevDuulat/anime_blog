<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::updateOrCreate(
      ['email' => 'admin@mail.ru'],
      [
        'name' => 'Admin',
        'email' => 'admin@mail.ru',
        'password' => Hash::make('password'),
      ]
    );
    $this->call([
      CategorySeeder::class,
      PostSeeder::class,
      CommentSeeder::class,
      QuizSeeder::class,
      QuestionSeeder::class,
      AnswerSeeder::class,
    ]);
  }
}
