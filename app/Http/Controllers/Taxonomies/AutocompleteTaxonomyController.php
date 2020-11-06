<?php

namespace App\Http\Controllers\Taxonomies;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Taxonomies\TaxonomyResource;

class AutocompleteTaxonomyController extends Controller
{
  public function __invoke(Request $request)
  {
    if ($request->get('tax', null) && $search = $request->get('search', null)) {
      return TaxonomyResource::collection(
        $request->user()->taxonomies()
          ->where('taxonomy', $request->get('tax', 'grammar'))
          ->where('name', 'LIKE', "%{$search}%")->limit(Taxonomy::$pagination)->get()
      );
    }
  }
}
