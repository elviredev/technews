<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsRequest;
use App\Models\Settings;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
  /**
   * @desc Affiche la page de modification des paramètres
   * Le form affiche les données existantes si elles sont en BDD, ou des champs vides rien n'a encore était configuré.
   * @return Factory|View|\Illuminate\View\View
   */
  public function index()
  {
    $settings = Settings::firstOrNew(['id' => 1]);

    return view('back.settings.index', compact('settings'));
  }

  /**
   * @desc Modifier les données Paramètres du site
   * Si l’enregistrement avec id=1 n’existe pas, Laravel le crée automatiquement
   * Si l'entrée avec ID=1 existe, elle est mise à jour.
   * @param SettingsRequest $request
   * @return RedirectResponse
   */
  public function update(SettingsRequest $request)
  {
    $validated = $request->validated();

    $setting = Settings::firstOrNew(['id' => 1]);

    // Gestion du logo
    if ($request->hasFile('logo')) {
      // Supprimer l'ancien si il existe
      if ($setting->logo) {
        Storage::disk('public')->delete($setting->logo);
      }

      // Sauvegarder le nouveau logo
      $validated['logo'] = $request->file('logo')->store('logo', 'public');
    }

    // Remplir et sauvegarder (update ou insert selon le cas)
    $setting->fill($validated);
    $setting->save();

    return back()->with('success', 'Vos paramètres ont bien été modifiés 💛');
  }
}
