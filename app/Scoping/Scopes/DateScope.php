<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class DateScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode('-', $value))) {
      if (!empty($values[0])) $builder->whereYear('terms.updated_at', $values[0]);
      if (!empty($values[1])) $builder->whereMonth('terms.updated_at', $values[1]);
      if (!empty($values[2])) $builder->whereDay('terms.updated_at', $values[2]);
    }

    return $builder;
  }
}
