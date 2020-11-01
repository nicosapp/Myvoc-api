<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class GrammarScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode(',', $value)))
      $builder->whereIn('terms.gram', $values);

    return $builder;
  }
}
