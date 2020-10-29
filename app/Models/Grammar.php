<?php

namespace App\Models;

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grammar extends Model
{
  use HasFactory;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function words()
  {
    return $this->belongsToMany(
      Word::class,
      'grammar_word',
      'grammar_id',
      'word_id',
    );
  }
}
