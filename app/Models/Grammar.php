<?php

namespace App\Models;

use App\Models\User;
use App\Models\Term;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grammar extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function terms()
  {
    return $this->belongsToMany(
      Term::class,
      'grammar_term',
      'grammar_id',
      'term_id',
    );
  }
}
