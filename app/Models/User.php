<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
  /** @use HasFactory<UserFactory> */
  use HasFactory, Notifiable;


  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'image',
    'role',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * @desc Envoyer email personnalisé de réinitialisation du MDP
   * @param $token
   * @return void
   */
  public function sendPasswordResetNotification($token): void
  {
    $this->notify(new CustomResetPassword($token));
  }

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * @desc Un utilisateur peut avoir plusieurs rôles
   * Un rôle peut être attribué à plusieurs utilisateurs
   * @return BelongsToMany
   */
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class);
  }

  /**
   * @desc Sert à vérifier si un utilisateur possède un ou plusieurs rôles
   * $this->roles récupère la collection de rôles liés à l’utilisateur.
   * pluck('name') extrait uniquement les noms des rôles (["admin", "author", "visitor"])
   * retourne true si l’utilisateur a au moins un des rôles donnés
   * @param string|array $roles
   * @return bool
   */
  public function hasRole(string|array $roles):bool
  {
    if (is_string($roles)) {
      return $this->roles->pluck('name')->contains($roles);
    }

    return $this->roles->pluck('name')->intersect($roles)->isnotEmpty();
  }

  /**
   * @desc Permet d'afficher le(s) rôle(s) du user dans l'interface
   * @return string
   */
  public function getRoleNamesAttribute(): string
  {
    return strtoupper($this->roles->pluck('name')->implode(', '));
  }
}
