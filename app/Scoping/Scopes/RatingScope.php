<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class RatingScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode(',', $value)))
      $builder->whereIn('words.note', $values);

    return $builder;
  }
}
