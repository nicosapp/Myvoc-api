<?php

namespace App\Http\Controllers\Words;

use App\Models\Word;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkCategoryController extends Controller
{
  public function link(Word $word, Category $category)
  {
    $word->categories()->syncWithoutDetaching([$category->id]);
    $word->save();
  }

  public function unlink(Word $word, Category $category)
  {
    $word->categories()->detach($category);
    $word->save();
  }
}
