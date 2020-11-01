<?php

namespace App\Http\Controllers\Grammars;

use App\Models\Grammar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Grammars\GrammarResource;

class GrammarController extends Controller
{
  public function index(Request $request)
  {
    return GrammarResource::collection(
      $request->user()->grammars()->orderBy('name', 'asc')->get()
    );
  }


  public function show(Grammar $grammar)
  {
    //authorize

    return new GrammarResource($grammar);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $grammar = $request->user()->grammars()->create($request->only('name'));
    return new GrammarResource($grammar);
  }

  public function update(Request $request, Grammar $grammar)
  {
    //authorize

    $this->validate($request, [
      'name' => 'string|min:2',
    ]);

    $grammar->update($request->only('name'));
    return new GrammarResource($grammar);
  }

  public function destroy(Grammar $grammar)
  {
    //authorize

    $grammar->delete();
  }
}
