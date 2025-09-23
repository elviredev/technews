<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
  use HasFactory, HasSlug, Taggable;

  protected $fillable = [
    'title',
    'slug',
    'image',
    'description',
    'isActive',
    'isComment',
    'isSharable',

    'category_id',
    'author_id',
  ];

  /**
   * @desc Génére le slug à partir du name (Spatie/Sluggable)
   * @return SlugOptions
   */
  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('title')
      ->saveSlugsTo('slug');
  }

  /**
   * @desc envoi directement le slug dans l'URL au lieu de l'ID
   * @return string
   */
  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  // afficher les images sous forme d'URL

  public function imageUrl(): string
  {
    return Storage::url($this->image);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id', 'id');
  }
}
