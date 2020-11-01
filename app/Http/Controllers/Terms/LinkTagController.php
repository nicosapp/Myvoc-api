<?php

namespace App\Http\Controllers\Terms;

use App\Models\Tag;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Taxonomy;

class LinkTagController extends Controller
{
  public function link(Term $term, Taxonomy $tag)
  {
    $term->tags()->syncWithoutDetaching([$tag->id]);
    $term->save();
  }

  public function unlink(Term $term, Taxonomy $tag)
  {
    $term->tags()->detach($tag);
    $term->save();
  }
}
