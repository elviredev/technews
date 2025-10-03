<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  /**
   * @desc Recherche du mot clé dans le titre ou la description de l'article
   * Affiche les articles contenant le mot clé
   * @param Request $request
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    $request->validate([
      'search_key' => ['required', 'string', 'min:3', 'max:255'],
    ]);

    $search = $request->search_key;
    $articles = Article::where('title', 'like', "%$search%")
        ->orWhere('description', 'like', "%$search%")
        ->get();

    return view('front.search', compact('articles', 'search'));
  }

  /**
   * @desc Affiche les articles correspondant au "tag" cliqué
   * @param $tag
   * @return \Illuminate\View\View
   */
  public function byTag($tag)
  {
    // Renvoi tous les articles avec ce tag
    $articles = Article::withAnyTag($tag)
      ->where('isActive', 1)
      ->get();

    return view('front.search', compact('articles'));
  }
}
