<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkCategoryController extends Controller
{
  public function link(Term $term, Category $category)
  {
    $term->categories()->syncWithoutDetaching([$category->id]);
    $term->save();
  }

  public function unlink(Term $term, Category $category)
  {
    $term->categories()->detach($category);
    $term->save();
  }
}
