<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Affiche les auteurs avec un role "author"
     * N'affiche pas l'utilisateur connecté dans la liste des auteurs
     */
    public function index()
    {
        return view('back.author.index', [
          'authors' => User::where('role', 'author')
                            ->where('id', '!=', Auth::id())
                            ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('back.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
      $validated = $request->validated();
      $validated['password'] = Hash::make('12345678');

      User::create($validated);

      return redirect()->route('author.index')->with('success', 'Auteur ajouté avec succès 🤩');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $author)
    {
      return view('back.author.create', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $author)
    {
      $validated = $request->validated();
      $author->update($validated);
      return redirect()->route('author.index')->with('success', 'Auteur modifié avec succès 💛');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $author)
    {
      // Si l'auteur a une image et qu'elle existe dans le disque
      if ($author->image && Storage::disk('public')->exists($author->image)) {
        Storage::disk('public')->delete($author->image);
      }

      $author->delete();

      return back()->with('success', 'Auteur supprimé avec succès 💚');
    }
}
