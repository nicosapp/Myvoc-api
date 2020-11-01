<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkExampleController extends Controller
{
  public function link(Term $term, Term $translation)
  {
    //authorize
    if ($translation->langue === 'fra') {
      $term->natives()->syncWithoutDetaching([$translation->id]);
    } else {
      $term->translations()->syncWithoutDetaching([$translation->id]);
    }
    $term->save();
  }

  public function unlink(Term $term, Term $translation)
  {
    // $this->authorize('update', $category);

    if ($translation->langue === 'fra') {
      $term->natives()->detach($translation);
    } else {
      $term->translations()->detach($translation);
    }
    $term->save();
  }
}
