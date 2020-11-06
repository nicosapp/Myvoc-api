<?php

namespace App\Scoping\Scopes;

use Illuminate\Database\Eloquent\Builder;

class TranslationScope
{
  public function apply(Builder $builder, $value)
  {
    $builder->whereHas('translations', function ($builder) use ($value) {
      $builder->where('translations.lang', $value);
    });
    return $builder;
  }
}
