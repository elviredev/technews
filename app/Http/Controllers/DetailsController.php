<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
  /**
   * @desc Permet d'afficher le détail d'un article et d'incrémenter le nombre de vues de la page
   * @param string $slug
   * @return Factory|View|\Illuminate\View\View
   */
  public function index(string $slug)
  {
    // Récupérer l'article par son slug
    $article = Article::where('slug', $slug)->firstOrFail();

    // Ajoute le nb de vues de l'article courant
    $new_view = $article->views + 1;
    $article->views = $new_view;
    $article->update();

    return view('front.details', compact('article'));
  }
}
