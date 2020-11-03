<?php

namespace App\Http\Resources\Terms;

use Illuminate\Http\Resources\Json\JsonResource;

class TermShortResource extends JsonResource
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
    ];
  }
}
