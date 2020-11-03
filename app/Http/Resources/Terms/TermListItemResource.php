<?php

namespace App\Http\Resources\Terms;

use Illuminate\Http\Resources\Json\JsonResource;

class TermListItemResource extends JsonResource
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
      'gram' => $this->gram,
      'note' => $this->note,
      'imp' => $this->imp,
      'level' => $this->level,
      'def_json' => $this->def_json ? json_decode($this->def_json, true) : null,
      'ex_json' => $this->ex_json ? json_decode($this->ex_json, true) : null,
      'web_def' => $this->web_def,
      'created_at' => $this->created_at,
      'udpated_at' => $this->updated_at,

      'translations' => $this->isNative() ?
        TermShortResource::collection($this->translations) : TermShortResource::collection($this->natives),
    ];
  }
}
