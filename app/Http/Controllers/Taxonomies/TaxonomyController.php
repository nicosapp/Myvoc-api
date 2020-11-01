<?php

namespace App\Http\Controllers\Taxonomies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Taxonomies\TaxonomyResource;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
  public function index(Request $request)
  {
    return TaxonomyResource::collection(
      $request->user()->taxonomies()
        ->where('taxonomy', $request->get('tax', 'grammar'))
        ->orderBy('order', 'asc')
        ->get()
    );
  }


  public function show(Taxonomy $taxonomy)
  {
    //authorize

    return new TaxonomyResource($taxonomy);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'string|min:2',
      'order' => 'integer|nullable'
    ]);

    $taxonomy = $request->user()->taxonomies()->create($request->only('name'));
    return new TaxonomyResource($taxonomy);
  }

  public function update(Request $request, Taxonomy $taxonomy)
  {
    //authorize

    $this->validate($request, [
      'name' => 'string|min:2',
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
