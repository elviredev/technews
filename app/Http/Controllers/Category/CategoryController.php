<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.category.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
      // Vérifier les données du formulaire
      $request->validated($request->all());

      // Enregistrer la category dans la bdd
      Category::create($request->all());

      return redirect()->route('category.index')
        ->with('success', 'La catégorie a été ajoutée avec succès 😊');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
      return view('back.category.create', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Valider les champs du form
        $request->validated($request->all());

        // Modifier les champs du form et envoyer les modifications vers la bdd
        $category->update($request->all());

        return redirect()->route('category.index')
          ->with('success', 'Catégorie modifiée avec succès 😊');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Catégorie supprimée avec succès 💚');
    }
}
