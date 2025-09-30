<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  protected $fillable = [
    'name',
    'email',
    'website',
    'message',

    'isActive',
  ];

  /**
   * @desc Un commentaire appartient à un article
   * @return BelongsTo
   */
  public function article(): BelongsTo
  {
    return $this->belongsTo(Article::class, 'article_id', 'id');
  }
}
