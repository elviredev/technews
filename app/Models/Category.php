<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
  use HasFactory, HasSlug;

  protected $fillable = [
    'name',
    'slug',
    'description',
    'isActive',
  ];

  /**
   * @desc Génére un slug depuis le champs 'name'
   * @return SlugOptions
   */
  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('name')
      ->saveSlugsTo('slug');
  }

  /**
   * @desc directement le slug dans l'URL au lieu de l'ID
   * Ex: http://127.0.0.1:8000/category/intelligence-artificielle/edit
   * @return string
   */
  public function getRouteKeyName(): string
  {
    return 'slug';
  }
}
