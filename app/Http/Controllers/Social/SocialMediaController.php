<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\StoreSocialMediaRequest;
use App\Http\Requests\SocialMedia\UpdateSocialMediaRequest;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.social.index', [
          'socials' => SocialMedia::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('back.social.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
      $validated = $request->validated();
      SocialMedia::create($validated);
      return redirect()->route('social.index')->with('success', 'Réseau Social ajouté avec succès 🤩');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social)
    {
      return view('back.social.create', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, SocialMedia $social)
    {
      $validated = $request->validated();
      $social->update($validated);
      return redirect()->route('social.index')->with('success', 'Réseau Social modifié avec succès 💛');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social)
    {
      $social->delete();

      return back()->with('success', 'Réseau Social supprimé avec succès 💚');
    }
}
