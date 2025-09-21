<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Exclure 'image' pour garder l'ancienne valeur tant qu'on ne gère pas l'upload
        $user->fill($request->safe()->except('image'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Gestion de l'image uniquement si envoyée
        if($request->hasFile('image')) {
          // Supprimer l'ancienne image si elle existe
          if(!empty($user->image) && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
          }

          // Sauvegarder la nouvelle image
          $path = $request->file('image')->store('profiles', 'public');

          // Enregistrer seulement le chemin relatif (ex: profiles/20250920_xxx.jpg)
          $user->image = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Profil modifié avec succès 😊');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
