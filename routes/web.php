<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(id: 1);

        return to_route('dashboard');

    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    #region Question Controllers
    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::post(uri: '/question/store', action: [QuestionController::class, 'store'])->name('question.store');
    Route::get(uri: '/question/{question}/edit', action: [QuestionController::class, 'edit'])->name('question.edit');
    Route::delete(uri: '/question/{question}', action: [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::post(uri: '/question/like/{question}', action: Question\LikeController::class)->name(name: 'question.like');
    Route::post(uri: '/question/unlike/{question}', action: Question\UnlikeController::class)->name(name: 'question.unlike');
    Route::put(uri: '/question/publish/{question}', action: Question\PublishController::class)->name(name: 'question.publish');
    # endregion

    #region Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    # endregion
});

require __DIR__ . '/auth.php';
