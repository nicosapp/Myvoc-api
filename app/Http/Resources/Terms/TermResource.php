<?php

namespace App\Http\Resources\Terms;

use App\Http\Resources\Terms\TermLightResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Categories\CategoryLightResource;
use App\Http\Resources\Grammars\GrammarResource;
use App\Http\Resources\Tags\TagResource;
use App\Http\Resources\Taxonomies\TaxonomyResource;

class TermResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'term' => $this->termLength(),
      'forme' => $this->forme,
      'langue' => $this->langue,
      'lang' => $this->lang,
      'pre' => $this->pre,
      'suf' => $this->suf,
      'pronon' => $this->pronon,
      'fra' => $this->fra,
      'gram' => $this->gram ? array_filter(explode(',', $this->gram), 'strlen') : [],
      'note' => $this->note,
      'imp' => $this->imp,
      'level' => $this->level,
      'conj' => $this->conj,
      'def_json' => $this->def_json ? json_decode($this->def_json, true) : null,
      'ex_json' => $this->ex_json ? json_decode($this->ex_json, true) : null,

      'categories' => CategoryLightResource::collection($this->categories),
      'grammars' => TaxonomyResource::collection($this->grammars),
      'synonyms' => [],
      'tags' => TaxonomyResource::collection($this->tags),
      'translations' => $this->isNative() ?
        TermLightResource::collection($this->translations) : TermLightResource::collection($this->natives),

      $this->mergeWhen($this->termLength() === 'short', [
        // 'examples' => TermLightResource::collection($this->examples)
      ]),
      $this->mergeWhen($this->termLength() === 'long', [
        // 'terms' => TermLightResource::collection($this->terms)
      ])

    ];
  }
}
