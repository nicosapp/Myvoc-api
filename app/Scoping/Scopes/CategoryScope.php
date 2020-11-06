<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class CategoryScope
{
  public function apply(Builder $builder, $value)
  {
    // return $builder->where('slug', $value);
    if (is_array($values = explode(',', $value))) {
      $builder->whereHas('categories', function ($builder) use ($values) {
        $builder->whereIn('categories.id', $values);
      });
    }
    return $builder;
    // return $builder->whereHas('categories', function($builder) use ($value){
    //
    // });
  }
}
