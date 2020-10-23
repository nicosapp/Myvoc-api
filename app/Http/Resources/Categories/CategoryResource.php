<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
      'order' => $this->order,
      'parent_id' => $this->parent_id,
      'words_count' => 0,
      // 'children' => CategoryResourceBase::collection($this->whenLoaded('children'))
      'children' => CategoryResource::collection($this->children)
    ];
  }
}
