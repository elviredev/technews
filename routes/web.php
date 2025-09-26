<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Social\SocialMediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Categories
Route::resource('/category', CategoryController::class);

// Articles
Route::resource('/article', ArticleController::class);

// Auteurs
Route::resource('/author', UserController::class);

// Social Media
Route::resource('/social', SocialMediaController::class);

// Settings
Route::get('/parametres', [SettingsController::class, 'index'])->name('settings.index');
Route::put('/modifier/parametres', [SettingsController::class, 'update'])->name('settings.update');

require __DIR__.'/auth.php';
