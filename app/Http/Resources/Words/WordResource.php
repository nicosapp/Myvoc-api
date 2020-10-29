<?php

namespace App\Http\Resources\Words;

use App\Http\Resources\Words\WordLightResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Categories\CategoryLightResource;
use App\Http\Resources\Grammars\GrammarResource;
use App\Http\Resources\Tags\TagResource;

class WordResource extends JsonResource
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
      'grammars' => GrammarResource::collection($this->grammars),
      'tags' => TagResource::collection($this->tags),
      'translations' => WordLightResource::collection($this->translations),
      'natives' => WordLightResource::collection($this->natives)
    ];
  }
}
