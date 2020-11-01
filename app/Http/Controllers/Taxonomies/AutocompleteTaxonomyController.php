<?php

namespace App\Http\Controllers\Taxonomies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Taxonomies\TaxonomyResource;
use Illuminate\Http\Request;

class AutocompleteTaxonomyController extends Controller
{
  public function __invoke(Request $request)
  {
    if ($request->get('tax', null) && $search = $request->get('search', null)) {
      return TaxonomyResource::collection(
        $request->user()->taxonomies()
          ->where('taxonomy', $request->get('tax', 'grammar'))
          ->where('name', 'LIKE', "%{$search}%")->limit(25)->get()
      );
    }
  }
}
