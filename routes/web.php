<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/media', [MediaItemController::class, 'index'])->name('media.index');
Route::get('/media-detail/{slug}', [MediaItemController::class, 'mediaDetail'])->name('media.detail');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{post:slug}/comments', [CommentController::class, 'storePostComment'])
  ->name('posts.comments.store')
  ->middleware('auth');

Route::post('/media/{mediaItem}/comments', [CommentController::class, 'storeMediaComment'])
  ->name('media.comments.store')
  ->middleware('auth');

Route::get('/category/{slug}', [MediaItemController::class, 'byCategory'])->name('category.show');
Route::get('/media/{slug}', [MediaItemController::class, 'show'])->name('media.show');

Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
Route::post('/quizzes/{quizId}/questions/{questionId}', [QuizController::class, 'processAnswer'])
    ->name('quizzes.process');
    Route::get('/quizzes/{id}/results', [QuizController::class, 'showResults'])
    ->name('quizzes.results');

Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
