<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FrontContactController extends Controller
{
  /**
   * @desc Affiche le formulaire de contact sur la partie Frontend
   * @return \Illuminate\View\View
   */
  public function index(): \Illuminate\View\View
  {
    return view('front.contact');
  }

  /**
   * @desc Récupérer les données du formulaire
   * @param StoreContactRequest $request
   * @return RedirectResponse
   */
  public function contact(StoreContactRequest $request): RedirectResponse
  {
    $validated = $request->validated();

    Contact::create($validated);

    return back()->with('success', 'Nous avons bien reçu votre message, nous vous contacterons dans les meilleurs délais !');
  }

}
