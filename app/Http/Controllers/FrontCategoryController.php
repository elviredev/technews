<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
  /**
   * @desc Affiche la page Catégorie avec ses articles ratttachés
   * @param string $slug
   * @return Factory|View|\Illuminate\View\View
   */
  public function index(string $slug)
  {
    $category = Category::where('slug', $slug)
      ->where('isActive', 1)
      ->with('articles')
      ->firstOrFail();

    return view('front.category', compact('category'));
  }
}
