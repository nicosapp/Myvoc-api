<?php

namespace App\Http\Controllers\Words;

use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkTranslationController extends Controller
{
  public function link(Word $word, Word $translation)
  {
    //authorize
    if ($translation->langue === 'fra') {
      $word->natives()->syncWithoutDetaching([$translation->id]);
    } else {
      $word->translations()->syncWithoutDetaching([$translation->id]);
    }
    $word->save();
  }

  public function unlink(Word $word, Word $translation)
  {
    // $this->authorize('update', $category);

    if ($translation->langue === 'fra') {
      $word->natives()->detach($translation);
    } else {
      $word->translations()->detach($translation);
    }
    $word->save();
  }
}
