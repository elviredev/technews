<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      if (Auth::user()->hasRole('admin')) {
        $articles = Article::all();
      } else {
        $articles = Article::where('author_id', Auth::user()->id)->get();
      }

      return view('back.article.index', compact('articles'));
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

      if ($request->hasFile('image')) {
        $imageFile = $request->file('image');

        // Générer un nom unique
        $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

        // Créer le chemin
        $path = "articles/{$filename}";

        // Créer le manager (driver GD ou Imagick)
        $manager = new ImageManager(new Driver());

        // Intervention v3 : lecture + resize + compression
        $image = $manager->read($imageFile)
          ->scale(width: 800) // redimensionne la largeur à 800px max
          ->toJpeg(80); // compresse en jpeg qualité 80%

        // Sauvegarder dans le disque public
        Storage::disk('public')->put($path, $image);

        // Ajouter dans les données validées
        $validated['image'] = $path;
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

        $imageFile = $request->file('image');
        $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $path = "articles/{$filename}";

        // Créer le manager avec GD
        $manager = new ImageManager(new Driver());

        // Lecture + resize + compression
        $image = $manager->read($imageFile)
          ->scale(width: 800)   // largeur max 800px
          ->toJpeg(80); // compression qualité 80%

        // Sauvegarde
        Storage::disk('public')->put($path, (string) $image);

        $validated['image'] = $path;
      }

      // Mise à jour de l'article
      $article->update($validated);

      // Tags
      $tags = explode(',', $request->tags);
      $article->retag($tags);

      return redirect()->route('article.index')->with('success', 'Votre article a bien été modifié 💛');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
      $article->delete();

      return back()->with('success', 'Article supprimé avec succès 💚');
    }
}
