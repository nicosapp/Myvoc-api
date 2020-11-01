<?php

namespace App\Http\Resources\Dictionnaries;

use Illuminate\Http\Resources\Json\JsonResource;

class DictionnaryResource extends JsonResource
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
      'slug' => $this->slug,
      'name' => $this->name,
      'color' => $this->color,
      'order' => $this->order
    ];
  }
}
