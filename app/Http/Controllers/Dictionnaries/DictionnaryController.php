<?php

namespace App\Http\Controllers\Dictionnaries;

use App\Models\Dictionnary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dictionnaries\DictionnaryResource;

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
      'name' => [
        'required',
        'string',
        'min:3',
        Rule::unique('dictionnaries')->where(function ($query) use ($request) {
          return $query->where('user_id', $request->user()->id);
        })
      ],
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
      'name' => [
        'sometimes',
        'required',
        'string',
        'min:3',
        Rule::unique('dictionnaries')->where(function ($query) use ($request) {
          return $query->where('user_id', $request->user()->id);
        })
      ],
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
