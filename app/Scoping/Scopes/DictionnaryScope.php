<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class DictionnaryScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode(',', $value)))
      $builder->whereIn('terms.langue', $values);

    return $builder;
  }
}
