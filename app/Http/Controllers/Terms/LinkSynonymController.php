<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkSynonymController extends Controller
{
  public function link(Term $term, Term $synonym)
  {
    //authorize
    if (!$term->synonyms_reverse()->where('terms.id', $synonym->id)->exists()) { //check if record exist in reverse
      $term->synonyms()->syncWithoutDetaching([$synonym->id]);
    }
    $term->save();
  }

  public function unlink(Term $term, Term $synonym)
  {
    // $this->authorize('update', $category);

    if ($term->synonyms_reverse()->where('terms.id', $synonym->id)->exists()) {
      $term->synonyms_reverse()->detach($synonym);
    } else {
      $term->synonyms()->detach($synonym);
    }
    $term->save();
  }
}
