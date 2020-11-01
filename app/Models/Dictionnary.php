<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dictionnary extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'key', 'order', 'color'];


  public static function boot()
  {
    parent::boot();

    static::creating(function (Dictionnary $dictionnary) {
      // produce a slug based on the activity title
      $slug = Str::slug(substr($dictionnary->name, 0, 3));

      // check to see if any other slugs exist that are the same & count them
      $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count(); //unique

      // if other slugs exist that are the same, append the count to the slug
      $dictionnary->slug = $count ? "{$slug}-{$count}" : $slug;

      return $dictionnary;
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
