<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Social\SocialMediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Page d'accueil FRONTEND
Route::get('/', [HomeController::class, 'index'])->name('home');

// Page de détails d'un article FRONTEND
Route::get('/details/{slug}', [DetailsController::class, 'index'])->name('article.details');

// Commentaires sur un article FRONTEND
Route::post('/comment/{id}', [DetailsController::class, 'storeComment'])->name('article.comment');

// Dashboard BACKEND
Route::get('/dashboard', [DashboardController::class, 'index'])
  ->middleware(['auth', 'verified', 'checkRole:admin,author'])
  ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Categories BACKEND
Route::resource('/category', CategoryController::class)
  ->middleware('admin');

// Articles BACKEND
Route::resource('/article', ArticleController::class)->middleware('checkRole:admin,author');

// Auteurs BACKEND
Route::resource('/author', UserController::class)
  ->middleware('admin');

// Social Media BACKEND
Route::resource('/social', SocialMediaController::class)
  ->middleware('admin');

// Settings BACKEND
Route::get('/parametres', [SettingsController::class, 'index'])->name('settings.index')
  ->middleware('admin');
Route::put('/modifier/parametres', [SettingsController::class, 'update'])->name('settings.update')
  ->middleware('admin');

// Commentaires BACKEND
Route::resource('/comment', CommentController::class);
Route::put('/comment/unlock/{id}', [CommentController::class, 'unlock'])->name('comment.unlock');

require __DIR__.'/auth.php';
