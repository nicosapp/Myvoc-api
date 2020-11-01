<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Taxonomy;

class LinkGrammarController extends Controller
{
  public function link(Term $term, Taxonomy $grammar)
  {
    $term->grammars()->syncWithoutDetaching([$grammar->id]);
    $term->save();
  }

  public function unlink(Term $term, Taxonomy $grammar)
  {
    $term->grammars()->detach($grammar);
    $term->save();
  }
}
