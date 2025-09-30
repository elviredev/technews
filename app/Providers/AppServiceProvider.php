<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      // Partie Backend - Autorisations
      Gate::define('admin-access', function ($user) {
        return $user->hasRole('admin');
      });

      Gate::define('author-access', function ($user) {
        return $user->hasRole('author');
      });

      Gate::define('admin-or-author-access', function ($user) {
        return $user->hasRole(['admin', 'author']);
      });

      // Carbon en français applicable sur toutes les vues blade
      Carbon::setLocale(config('app.locale'));

      // Partie Frontend - Partage des infos dans toutes les vues
      $socials = SocialMedia::orderBy('id', 'desc')->get();
      $categories = Category::where('isActive', 1)->orderBy('created_at', 'desc')->get();
      $articles = Article::where('isActive', 1)->orderBy('created_at', 'desc')->limit(5)->get();
      $tags = Tag::orderBy('id', 'desc')->limit(15)->get();


      view()->share('global_socials', $socials);
      view()->share('global_categories', $categories);
      view()->share('global_recent_articles', $articles);
      view()->share('global_tags', $tags);
    }
}
