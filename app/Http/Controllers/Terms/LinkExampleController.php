<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkExampleController extends Controller
{
  public function link(Term $term, Term $example)
  {
    //authorize
    if ($term->termLength() === 'short') {
      $term->examples()->syncWithoutDetaching([$example->id]);
    } else {
      $term->terms()->syncWithoutDetaching([$example->id]);
    }
    $term->save();
  }

  public function unlink(Term $term, Term $example)
  {
    // $this->authorize('update', $category);

    if ($term->termLength() === 'short') {
      $term->examples()->detach($example);
    } else {
      $term->terms()->detach($example);
    }
    $term->save();
  }
}
