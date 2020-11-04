<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxonomyMeta extends Model
{
  use HasFactory;

  public function taxonomy()
  {
    return $this->belongsTo(Taxonomy::class);
  }
}
