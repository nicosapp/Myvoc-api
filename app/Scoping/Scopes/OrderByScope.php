<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class OrderByScope
{
  public function apply(Builder $builder, $value)
  {
    $values = explode(',', $value);
    $orderby = $values[0];
    $seed = isset($values[1]) ? $values[1] : 12;

    $builder->orderby('terms.forme', 'asc');

    switch ($orderby) {
      case 'alphabetical':
        $builder->orderby('terms.lang', 'asc');
        break;
      case 'date':
        $builder->latest('terms.updated_at');;
        break;
      case 'random':
        $builder->inRandomOrder($seed);
        break;
      case 'grammar':
        $builder->orderby('terms.gram', 'asc');
        break;
      case 'level':
        $builder->orderby('terms.level', 'asc');
        break;
      case 'rating':
        $builder->orderby('terms.rating', 'asc');
        break;
      case 'highlight':
        $builder->orderby('terms.highlight', 'asc');
        break;
    }

    return $builder;
  }
}
