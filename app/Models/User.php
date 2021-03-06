<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Term;
use App\Models\Grammar;
use App\Models\Dictionnary;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\WithMediaConversion;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ApiResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
  use HasFactory, Notifiable, CanResetPassword, InteractsWithMedia, WithMediaConversion;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public static $mediaCollectionName = "avatars";

  public static function boot()
  {
    parent::boot();

    static::created(function (User $user) {
      $user->infos()->create();
    });
    static::creating(function (User $user) {
      $user->uuid = Str::uuid();
    });
  }

  public function getRouteKeyName()
  {
    return 'uuid';
  }

  //Password Attribute
  public function setPasswordAttribute($password)
  {
    if (trim($password) === '') {
      return;
    }
    $this->attributes['password'] = Hash::make($password);
  }

  public function infos()
  {
    return $this->hasOne(UserInfo::class);
  }

  public function avatar()
  {
    return $this->getMedia(self::$mediaCollectionName)->first();
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->thumbnail();
  }

  public function social()
  {
    return $this->hasMany(UserSocial::class);
  }

  public function hasSocialLinked($service)
  {
    return (bool) $this->social->where('service', $service)->count();
  }

  public function dictionnaries()
  {
    return $this->hasMany(Dictionnary::class);
  }

  public function terms()
  {
    return $this->hasMany(
      Term::class,
      'user_id'
    );
  }

  public function categories()
  {
    return $this->hasMany(Category::class);
  }

  public function grammars()
  {
    return $this->hasMany(Grammar::class);
  }

  public function taxonomies()
  {
    return $this->hasMany(Taxonomy::class);
  }

  public function tags()
  {
    return $this->hasMany(Tag::class);
  }
}
