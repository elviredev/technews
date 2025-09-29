<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $author_articles = [];

    if ($user->hasRole('author')) {
      $author_articles = Article::where('author_id', $user->id)->count();
    }

    $articles = Article::all();
    $recent_articles = Article::where('isActive', 1)
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();
    $nb_categories = Category::count();

    return view('back.dashboard', [
      'author_articles' => $author_articles,
      'articles' => $articles,
      'recent_articles' => $recent_articles,
      'nb_categories' => $nb_categories,
    ]);
  }
}
