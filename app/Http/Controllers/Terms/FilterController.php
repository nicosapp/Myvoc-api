<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Scoping\Scopes\OrderBy;
use App\Scoping\Scopes\DateScope;
use App\Scoping\Scopes\TypeScope;
use App\Scoping\Scopes\LevelScope;
use App\Scoping\Scopes\RatingScope;
use App\Http\Controllers\Controller;
use App\Scoping\Scopes\GrammarScope;
use App\Scoping\Scopes\OrderByScope;
use App\Scoping\Scopes\CategoryScope;
use App\Scoping\Scopes\HighlightScope;
use App\Scoping\Scopes\DictionnaryScope;
use App\Http\Resources\Terms\TermListItemResource;
use App\Scoping\Scopes\TagScope;

class FilterController extends Controller
{
  public function __invoke(Request $request)
  {
    return TermListItemResource::collection(
      Term::where('user_id', $request->user()->id)
        ->withScopes($this->scopes())
        ->paginate(Term::$pagination)
    );
  }

  public function scopes()
  {
    return [
      'dictionnary' => new DictionnaryScope(),
      'category' => new CategoryScope(),
      'type' => new TypeScope(),
      'grammar' => new GrammarScope(),
      'highlight' => new HighlightScope(),
      'level' => new LevelScope(),
      'rating' => new RatingScope(),
      'date' => new DateScope(),
      'tag' => new TagScope(),
      'orderby' => new OrderByScope(),

    ];
  }
}
