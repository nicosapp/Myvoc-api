<?php

namespace App\Http\Controllers\Taxonomies;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Taxonomies\TaxonomyResource;

class TaxonomyController extends Controller
{
  public function index(Request $request)
  {
    return TaxonomyResource::collection(
      $request->user()->taxonomies()
        ->where('taxonomy', $request->get('tax', 'grammar'))
        ->orderBy('order', 'asc')
        ->paginate(Taxonomy::$pagination)
    );
  }

  public function list(Request $request)
  {
    return response()->json([
      'data' => $request->user()->taxonomies()->select('taxonomy as name')
        ->groupBy('taxonomy')->get()
    ]);
  }


  public function show(Taxonomy $taxonomy)
  {
    //authorize

    return new TaxonomyResource($taxonomy);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'taxonomy' => 'string|required',
      'name' => [
        'required',
        'string',
        'min:2',
        Rule::unique('taxonomies')->where(function ($query) use ($request) {
          return $query->where('taxonomy', $request->get('taxonomy'))->where('user_id', $request->user()->id);
        })
      ],
      'order' => 'integer|nullable'
    ]);

    $taxonomy = $request->user()->taxonomies()->create($request->only('name', 'taxonomy', 'order'));
    return new TaxonomyResource($taxonomy);
  }

  public function update(Request $request, Taxonomy $taxonomy)
  {
    //authorize

    $this->validate($request, [
      'name' => [
        'sometimes',
        'required',
        'string',
        'min:2',
        Rule::unique('taxonomies')->where(function ($query) use ($request) {
          return $query->where('taxonomy', $request->get('taxonomy'))->where('user_id', $request->user()->id);
        })
      ],
      'order' => 'integer|nullable'
    ]);

    $taxonomy->update($request->only('name'));
    return new TaxonomyResource($taxonomy);
  }

  public function destroy(Taxonomy $taxonomy)
  {
    //authorize

    $taxonomy->delete();
  }
}
