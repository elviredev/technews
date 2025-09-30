<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;
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
    // Récupérer l'article par son slug avec les commentaires
    $article = Article::where('slug', $slug)->with('comments')->firstOrFail();

    // Ajoute le nb de vues de l'article courant
    $new_view = $article->views + 1;
    $article->views = $new_view;
    $article->update();

    return view('front.details', compact('article'));
  }

  public function storeComment(StoreCommentRequest $request, int $id)
  {
    $validated = $request->validated();

    $article = Article::findOrFail($id);
    $article->comments()->create($validated);

    return back()->with('success', 'Commentaire envoyé avec succès 💜');
  }
}
