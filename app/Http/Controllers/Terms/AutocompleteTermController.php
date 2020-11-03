<?php

namespace App\Http\Controllers\Terms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Terms\TermListItemResource;
use Illuminate\Http\Request;

class AutocompleteTermController extends Controller
{
  public function __invoke(Request $request)
  {
    if (!$search = $request->get('search', null)) {
      return null;
    }
    return TermListItemResource::collection(
      $request->user()->terms()
        ->where([
          [$request->get('column', 'lang'), 'LIKE', "%{$search}%"],
          ['langue', '=', $request->get('langue', 'fra')],
        ])
        ->whereIn('forme', [$request->get('forme', 'word')])->limit(25)->get()
    );
  }
}
