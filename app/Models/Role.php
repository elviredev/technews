<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
  protected $fillable = ['name'];

  /**
   * @desc Un rôle peut être attribué à plusieurs utilisateurs
   * @return BelongsToMany
   */
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }
}
