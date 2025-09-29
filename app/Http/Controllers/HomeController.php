<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $articles = Article::where('isActive', 1)->orderBy('created_at', 'desc')->limit(10)->get();

    return view('front.home', compact('articles'));
  }
}
