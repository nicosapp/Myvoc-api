<?php

namespace App\Http\Controllers\Words;

use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Words\WordResource;

class WordController extends Controller
{
  public function __contruct()
  {
  }

  public function index(Request $request)
  {
    return WordResource::collection($request->user()->words()->paginate(100));
  }

  public function show(Request $request, Word $word)
  {
    //authorise

    return new WordResource($word);
  }

  public function store(Request $request, Word $word)
  {
    $word = $request->user()->words()->create();
    return new WordResource($word);
  }

  public function update(Request $request, Word $word)
  {
    //authorization
    // $this->authorize('update', $word);
    //validate
    $this->validate($request, [
      'langue' => 'string|nullable',
      'cross_dico' => 'numeric|nullable',
      'forme' => 'string|nullable',
      'lang' => 'string|nullable',
      'pre' => 'string|nullable',
      'suf' => 'string|nullable',
      'fra' => 'string|nullable',
      'pronon' => 'string|nullable',
      'note' => 'numeric|nullable',
      'imp' => 'numeric|nullable',
      'def_json' => 'nullable',
      'ex_json' => 'nullable',
      'conj' => 'string|nullable',
    ]);

    $word->update($request->only('lang', 'pre', 'suf', 'fra', 'pronon', 'note', 'imp', 'ex_json', 'def_json'));
  }

  public function destroy(Request $request, Word $word)
  {
    //authorization
    // $this->authorize('destroy', $word);

    $word->delete();
  }
}
