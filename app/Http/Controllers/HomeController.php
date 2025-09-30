<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * @desc Affichage des articles et catégories sur la Homepage
   * @return Factory|View|\Illuminate\View\View
   */
  public function index()
  {
    // Liste des articles
    $articles = Article::where('isActive', 1)
      ->orderBy('created_at', 'desc')
      ->limit(10)
      ->get();

    // Catégories actives ayant au moins 1 article
    $categories = Category::where('isActive', 1)
      ->orderBy('created_at', 'desc')
      ->with('articles')
      ->has('articles')
      ->get();

    return view('front.home', compact('articles', 'categories'));
  }
}
