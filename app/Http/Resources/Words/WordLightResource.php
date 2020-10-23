<?php

namespace App\Http\Resources\Words;

use Illuminate\Http\Resources\Json\JsonResource;

class WordLightResource extends JsonResource
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
      'gram' => $this->gram,
      'note' => $this->note,
      'imp' => $this->imp,
      'level' => $this->level
    ];
  }
}
