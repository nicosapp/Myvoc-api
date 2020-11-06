<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class CrossDicoScope
{
  public function apply(Builder $builder, $value)
  {
    $builder->whereHas('translations', function ($builder) use ($value) {
      $builder->where('translations.cross_dico', $value);
    });
    return $builder;
  }
}
