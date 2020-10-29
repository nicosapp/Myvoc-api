<?php

namespace App\Http\Resources\Grammars;

use Illuminate\Http\Resources\Json\JsonResource;

class GrammarResource extends JsonResource
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
      'name' => $this->name,
      'user_id' => $this->user_id,
      'words_count' => 0,
    ];
  }
}
