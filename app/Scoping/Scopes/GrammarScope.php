<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class GrammarScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode(',', $value))) {
      $builder->whereHas('grammars', function ($builder) use ($values) {
        $builder->whereIn('taxonomies.id', $values);
      });
    }
    return $builder;
  }
}
