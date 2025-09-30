<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $articles = Article::where('isActive', 1)
      ->orderBy('created_at', 'desc')
      ->limit(10)
      ->get();

    // Catégories active ayant au moins 1 article
    $categories = Category::where('isActive', 1)
      ->orderBy('created_at', 'desc')
      ->with('articles')
      ->has('articles')
      ->get();

    return view('front.home', compact('articles', 'categories'));
  }
}
