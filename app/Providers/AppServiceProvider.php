<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Settings;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
    Gate::define('admin-access', fn($user) => $user->hasRole('admin'));
    Gate::define('author-access', fn($user) => $user->hasRole('author'));
    Gate::define('admin-or-author-access', fn($user) => $user->hasRole(['admin', 'author']));

    // Carbon en français
    Carbon::setLocale(config('app.locale'));

    // Partie Frontend - Partage des infos dans toutes les vues
    View::composer('*', function ($view) {

      $socials = collect();
      $categories = collect();
      $articles = collect();
      $tags = collect();
      $settings = null;
      $popular_articles = collect();

      // On vérifie d'abord si la DB est accessible avant de lancer les requêtes
      if ($this->databaseIsConnected()) {
        try {
          $socials = cache()->remember('global_socials', 3600, fn() => SocialMedia::orderByDesc('id')->get());
          $categories = cache()->remember('global_categories', 3600, fn() => Category::where('isActive', 1)->orderByDesc('created_at')->get());
          $articles = cache()->remember('global_recent_articles', 3600, fn() => Article::where('isActive', 1)->orderByDesc('created_at')->limit(5)->get());
          $tags = cache()->remember('global_tags', 3600, fn() => Tag::orderByDesc('id')->limit(15)->get());
          $settings = cache()->remember('global_settings', 3600, fn() => Settings::find(1));
          $popular_articles = cache()->remember('global_popular_articles', 3600, fn() => Article::where('isActive', 1)
            ->orderByDesc('created_at')
            ->orderByDesc('views')
            ->limit(3)->get());
        } catch (\Exception $e) {
          // Si une erreur DB survient malgré tout, on continue avec les valeurs par défaut
        }
      }

      $view->with('global_socials', $socials);
      $view->with('global_categories', $categories);
      $view->with('global_recent_articles', $articles);
      $view->with('global_tags', $tags);
      $view->with('global_settings', $settings);
      $view->with('global_popular_articles', $popular_articles);
    });
  }

  /**
   * Vérifie si la base de données est accessible
   */
  protected function databaseIsConnected(): bool
  {
    try {
      DB::connection()->getPdo();
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }
}
