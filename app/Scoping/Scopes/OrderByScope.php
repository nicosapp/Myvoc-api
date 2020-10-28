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

    switch ($orderby) {
      case 'alphabetical':
        $builder->orderby('words.lang', 'asc');
        break;
      case 'date':
        $builder->latest('words.updated_at');;
        break;
      case 'random':
        $builder->inRandomOrder($seed);
        break;
      case 'grammar':
        $builder->orderby('words.gram', 'asc');
        break;
      case 'level':
        $builder->orderby('words.level', 'asc');
        break;
      case 'rating':
        $builder->orderby('words.rating', 'asc');
        break;
      case 'highlight':
        $builder->orderby('words.highlight', 'asc');
        break;
    }

    return $builder;
  }
}
