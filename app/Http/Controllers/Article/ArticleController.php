<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.article.index', [
          'articles' => Article::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', [
          'categories' => Category::where('isActive', 1)->get()
          ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
      // $validated contient les champs du formulaire validés
      $validated = $request->validated();

      // Utiliser $validated plutôt que request puis merger avec l'image et l'auteur
      if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('articles', 'public');
      }

      $validated['author_id'] = Auth::id();

      // Tags
      $tags = explode(',', $request->tags);

      $article = Article::create($validated);

      $article->tag($tags);

      return redirect()->route('article.index')->with('success', 'Votre article a bien été enregistré 💛');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('back.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
      return view('back.article.create', [
        'article' => $article,
        'categories' => Category::where('isActive', 1)->get()
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
      // $validated contient les champs du formulaire validés
      $validated = $request->validated();

      // Gestion de l'image
      if ($request->hasFile('image')) {
        // Supprimer l'ancienne si elle existe
        if ($article->image) {
          Storage::disk('public')->delete($article->image);
        }

        // Sauvegarder la nouvelle
        $validated['image'] = $request->file('image')->store('articles', 'public');
      }

      // Mise à jour de l'article
      $article->update($validated);

      // Tags
      $tags = explode(',', $request->tags);
      $article->tag($tags);

      return redirect()->route('article.index')->with('success', 'Votre article a bien été modifié 💛');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
