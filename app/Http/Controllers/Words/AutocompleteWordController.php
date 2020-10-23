<?php

namespace App\Http\Controllers\Words;

use App\Http\Controllers\Controller;
use App\Http\Resources\Words\WordLightResource;
use Illuminate\Http\Request;

class AutocompleteWordController extends Controller
{
  public function __invoke(Request $request)
  {
    if (!$search = $request->get('search', null)) {
      return null;
    }
    return WordLightResource::collection(
      $request->user()->words()
        ->where([
          [$request->get('column', 'lang'), 'LIKE', "%{$search}%"],
          ['langue', '=', $request->get('langue', 'fra')]
        ])->limit(25)->get()
    );
  }
}
