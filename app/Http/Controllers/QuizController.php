<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
      public function index()
      {
          $quizzes = Quiz::with('category:id,name')
              ->select('id', 'title', 'image', 'category_id')
              ->get();
          $blogPosts = Post::with(['category', 'user'])
          ->latest()
          ->take(5)
          ->get();

          return view('quiz.index', compact('quizzes',    'blogPosts'));
      }

      public function show($id)
      {
          session()->forget('correct_answers');

          $quiz = Quiz::with(['questions.answers'])->findOrFail($id);
          $firstQuestion = $quiz->questions->first();

          return view('quiz.show', [
              'quiz' => $quiz,
              'currentQuestion' => $firstQuestion,
              'questionNumber' => 1,
              'totalQuestions' => $quiz->questions->count()
          ]);
      }

      public function processAnswer(Request $request, $quizId, $questionId)
      {
          $validated = $request->validate([
              'answer' => 'required|exists:answers,id'
          ]);

          $quiz = Quiz::with('questions')->findOrFail($quizId);
          $currentQuestion = Question::findOrFail($questionId);

          // Проверка правильности ответа
          $isCorrect = Answer::find($validated['answer'])->is_correct;

          if ($isCorrect) {
              session()->increment('correct_answers');
          }

          $nextQuestion = $quiz->questions()
              ->where('id', '>', $currentQuestion->id)
              ->first();

          if ($nextQuestion) {
              return view('quiz.show', [
                  'quiz' => $quiz,
                  'currentQuestion' => $nextQuestion,
                  'questionNumber' => $quiz->questions()
                      ->where('id', '<=', $nextQuestion->id)
                      ->count(),
                  'totalQuestions' => $quiz->questions->count(),
                  'previousAnswerCorrect' => $isCorrect
              ]);
          }

          // Перенаправляем на страницу результатов
          return redirect()->route('quizzes.results', $quiz->id);
      }

      public function showResults($id)
      {
          $quiz = Quiz::with('questions.answers')->findOrFail($id);
          $totalQuestions = $quiz->questions->count();
          $correctAnswers = session()->get('correct_answers', 0);

          return view('quiz.results', [
              'quiz' => $quiz,
              'correctAnswers' => $correctAnswers,
              'totalQuestions' => $totalQuestions,
              'scorePercentage' => round(($correctAnswers / $totalQuestions) * 100)
          ]);
      }
}
