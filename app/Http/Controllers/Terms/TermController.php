<?php

namespace App\Http\Controllers\Terms;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Terms\TermResource;

class TermController extends Controller
{
  public function __contruct()
  {
  }

  public function index(Request $request)
  {
    return TermResource::collection($request->user()->terms()->paginate(100));
  }

  public function show(Request $request, Term $term)
  {
    //authorise

    return new TermResource($term);
  }

  public function store(Request $request, Term $term)
  {
    $term = $request->user()->terms()->create();
    return new TermResource($term);
  }

  public function update(Request $request, Term $term)
  {
    //authorization
    // $this->authorize('update', $term);
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

    $term->update($request->only('lang', 'pre', 'suf', 'fra', 'pronon', 'note', 'imp', 'ex_json', 'def_json', 'conj'));
  }

  public function destroy(Request $request, Term $term)
  {
    //authorization
    // $this->authorize('destroy', $term);

    $term->delete();
  }
}
