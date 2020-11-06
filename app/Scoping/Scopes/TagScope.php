<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class TagScope
{
  public function apply(Builder $builder, $value)
  {
    if (is_array($values = explode(',', $value))) {
      $builder->whereHas('tags', function ($builder) use ($values) {
        $builder->whereIn('taxonomies.id', $values);
      });
    }

    return $builder;
  }
}
