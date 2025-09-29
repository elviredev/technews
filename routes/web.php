<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Social\SocialMediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
  ->middleware(['auth', 'verified', 'checkRole:admin,author'])
  ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Categories
Route::resource('/category', CategoryController::class)
  ->middleware('admin');

// Articles
Route::resource('/article', ArticleController::class)->middleware('checkRole:admin,author');

// Auteurs
Route::resource('/author', UserController::class)
  ->middleware('admin');

// Social Media
Route::resource('/social', SocialMediaController::class)
  ->middleware('admin');

// Settings
Route::get('/parametres', [SettingsController::class, 'index'])->name('settings.index')
  ->middleware('admin');
Route::put('/modifier/parametres', [SettingsController::class, 'update'])->name('settings.update')
  ->middleware('admin');

require __DIR__.'/auth.php';
