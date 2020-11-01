<?php

namespace App\Http\Controllers\Dictionnaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dictionnaries\DictionnaryResource;
use App\Models\Dictionnary;
use Illuminate\Http\Request;

class DictionnaryController extends Controller
{
  public function index(Request $request)
  {
    return DictionnaryResource::collection(
      $request->user()->dictionnaries()->orderBy('order', 'asc')->get()
    );
  }

  public function show(Dictionnary $dictionnary)
  {
    //authorize

    return new DictionnaryResource($dictionnary);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|min:3',
      'color' => 'required|string',
      'order' => 'integer|nullable',
    ]);

    $dictionnary = $request->user()->dictionnaries()->create($request->only('name', 'color', 'order'));
    return new DictionnaryResource($dictionnary);
  }

  public function update(Request $request, Dictionnary $dictionnary)
  {
    //authorize

    $this->validate($request, [
      'name' => 'string|min:3',
      'color' => 'string',
      'order' => 'integer|nullable',
    ]);

    $dictionnary->update($request->only('name', 'order', 'color'));
    return new DictionnaryResource($dictionnary);
  }

  public function destroy(Dictionnary $dictionnary)
  {
    //authorize

    $dictionnary->delete();
  }
}
