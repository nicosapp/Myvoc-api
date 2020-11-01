<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkTranslationController extends Controller
{
  public function link(Request $request, Term $term, Term $translation)
  {
    //authorize

    if ($term->isNative()) {
      $term->translations()->syncWithoutDetaching([$translation->id]);
    } else {
      $term->natives()->syncWithoutDetaching([$translation->id]);
    }
    $term->save();
  }

  public function unlink(Request $request, Term $term, Term $translation)
  {
    // $this->authorize('update', $category);

    if ($term->isNative()) {
      $term->translations()->detach($translation);
    } else {
      $term->natives()->detach($translation);
    }
    $term->save();
  }
}
